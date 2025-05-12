<?php

namespace App\Services;

use App\Models\{TelegramGroup, TelegramUser, TelegramMessage};
use danog\MadelineProto\API;
use danog\MadelineProto\Settings;
use danog\MadelineProto\Settings\Logger;
use danog\MadelineProto\Settings\AppInfo;
use Illuminate\Support\Facades\Storage;

class TelegramParserService
{
    private API $madeline;

    public function __construct()
    {
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

        $this->madeline = new API($sessionPath, $settings);
    }

    public function parseGroup(string $username, int $limit = 100): void
    {
        $this->madeline->start();

        $this->madeline->sleep(1);

        // Получаем данные группы
        $groupData = $this->madeline->getPwrChat($username);
        $group = TelegramGroup::updateOrCreate(
            ['id' => $groupData['id']],
            [
                'username' => $groupData['username'] ?? null,
                'title' => $groupData['title'],
                'description' => $groupData['about'] ?? null
            ]
        );

        // Парсим сообщения
        $messages = $this->madeline->messages->getHistory([
            'peer' => $username,
            'limit' => $limit
        ]);

        foreach ($messages['messages'] as $msg) {
            // Сохраняем автора
            $userData = $this->madeline->getInfo($msg['from_id']);
            $user = TelegramUser::updateOrCreate(
                ['id' => $userData['User']['id']],
                [
                    'first_name' => $userData['User']['first_name'],
                    'last_name' => $userData['User']['last_name'] ?? null,
                    'username' => $userData['User']['username'] ?? null
                ]
            );

            // Сохраняем сообщение
            TelegramMessage::updateOrCreate(
                ['id' => $msg['id']],
                [
                    'group_id' => $group->id,
                    'user_id' => $user->id,
                    'text' => $msg['message'],
                    'date' => date('Y-m-d H:i:s', $msg['date'])
                ]
            );
        }
    }
}
