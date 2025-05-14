<?php

namespace App\Console\Commands;

use danog\MadelineProto\API;
use danog\MadelineProto\Settings;
use danog\MadelineProto\Settings\Logger;
use danog\MadelineProto\Settings\AppInfo;
use Illuminate\Console\Command;
use App\Models\TelegramGroup;
use App\Models\TelegramUser;
use App\Models\TelegramMessage;
use Illuminate\Support\Facades\Storage;

class ParseTelegramGroup extends Command
{
    protected $signature = 'parse-telegram 
                        {group=all : Username или ID группы (например: @mygroup)}
                        {--l|limit=100 : Лимит сообщений}';

    protected $description = 'Парсинг Telegram группы с авторизацией пользователя';

    public function handle()
    {
        $this->info('Инициализация MadelineProto...');

        if (!Storage::exists('telegram')) {
            Storage::makeDirectory('telegram');
        }

        $sessionPath = Storage::path('telegram/session.madeline');

        $settings = new Settings;

        $settings->setAppInfo(
            (new AppInfo)
                ->setApiId(env('TELEGRAM_API_ID'))
                ->setApiHash(env('TELEGRAM_API_HASH'))
        );

        // Настройка логгера
        $loggerSettings = new Logger;

        // Установка уровня логов (целочисленные константы)
        $loggerSettings->setLevel(3); // 3 = ERROR (только ошибки)

        $settings->setLogger($loggerSettings);

        $madeline = new API($sessionPath, $settings);

        // Авторизация
        $this->authorizeUser($madeline);

        if ($this->argument('group') !== 'all') {
            // Парсинг группы
            $this->parseGroup(
                $madeline,
                $this->argument('group'),
                $this->option('limit')
            );
        } else {
            TelegramGroup::active()->chunk(5, function ($telegramGroups) use ($madeline) {
                foreach ($telegramGroups as $group) {
                    $this->parseGroup(
                        $madeline,
                        $group->username,
                        $this->option('limit')
                    );
                }
            });
        }
    }

    protected function authorizeUser(API $madeline)
    {
        $this->info('Авторизация в Telegram...');
        $madeline->start();

        if (!$madeline->getSelf()) {
            $phone = $this->ask('Введите номер телефона (в формате +79123456789):');
            $madeline->phoneLogin($phone);

            $code = $this->secret('Введите код из SMS/Telegram:');
            $madeline->completePhoneLogin($code);

            if ($madeline->getAuthorization() === API::WAITING_PASSWORD) {
                $password = $this->secret('Введите пароль двухфакторной аутентификации:');
                $madeline->complete2faLogin($password);
            }
        }

        $user = $madeline->getSelf();
        $username = $user['username'] ?? 'без username';
        $this->info("Авторизован как: {$user['first_name']} (@{$username})");
    }

    protected function parseGroup(API $madeline, string $group, int $limit)
    {
        $this->info("Парсинг и сохранение группы {$group}...");

        try {
            // Получаем информацию о группе
            $groupInfo = $madeline->getPwrChat($group);

            // Сохраняем группу
            $groupModel = TelegramGroup::updateOrCreate(
                ['id' => $groupInfo['id']],
                [
                    'username' => $groupInfo['username'] ?? null,
                    'title' => $groupInfo['title'],
                    'description' => $groupInfo['about'] ?? null,
                ]
            );

            $this->info("Группа сохранена: {$groupModel->title}");

            // Получаем ID последнего сохранённого сообщения
            $lastMessageId = TelegramMessage::where('group_id', $groupModel->id)
                ->latest('id')
                ->value('id') ?? 0;

            // Получаем сообщения
            $messages = $madeline->messages->getHistory([
                'peer' => $group,
                'offset_id' => $lastMessageId,
                'limit' => $limit
            ]);

            $bar = $this->output->createProgressBar(count($messages['messages']));
            $bar->start();

            foreach ($messages['messages'] as $message) {

                // Пропускаем служебные сообщения без текста
                if (empty($message['message'])) {
                    $bar->advance();
                    continue;
                }

                // Обрабатываем разные форматы from_id
                $userId = $this->resolveUserId($message);
                if (!$userId) {
                    $bar->advance();
                    continue;
                }

                // Получаем информацию об авторе
                $userInfo = $madeline->getInfo(['_' => 'inputUser', 'user_id' => $userId]);
                $user = $this->saveUser($userInfo['User']);

                // Сохраняем сообщение
                TelegramMessage::updateOrCreate(
                    ['id' => $message['id']],
                    [
                        'group_id' => $groupModel->id,
                        'user_id' => $user->id,
                        'text' => $message['message'],
                        'date' => date('Y-m-d H:i:s', $message['date']),
                    ]
                );

                $bar->advance();
            }

            $bar->finish();
            $this->newLine();

            $this->info("Сохранено сообщений: " . TelegramMessage::where('group_id', $groupModel->id)->count());
        } catch (\Exception $e) {
            $this->error("Ошибка: " . $e->getMessage());
        }
    }

    protected function resolveUserId(array $message): ?int
    {
        // Вариант 1: from_id как объект с user_id
        if (isset($message['from_id']['user_id'])) {
            return $message['from_id']['user_id'];
        }

        // Вариант 2: from_id как числовой ID (ваш случай)
        if (is_numeric($message['from_id'])) {
            return $message['from_id'];
        }

        // Вариант 3: from_id как объект peerUser
        if ($message['from_id']['_'] === 'peerUser') {
            return $message['from_id']['user_id'];
        }

        // Для сообщений без пользователя (системные)
        return null;
    }

    protected function saveUser(array $userData): TelegramUser
    {
        if (empty($userData['id']) || empty($userData['first_name'])) {
            throw new \Exception("Invalid user data: " . json_encode($userData));
        }

        return TelegramUser::updateOrCreate(
            ['id' => $userData['id']],
            [
                'first_name' => $userData['first_name'],
                'last_name' => $userData['last_name'] ?? null,
                'username' => $userData['username'] ?? null,
            ]
        );
    }
}
