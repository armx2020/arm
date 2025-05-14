<?php

namespace App\Services;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use danog\MadelineProto\API;
use danog\MadelineProto\Settings;
use danog\MadelineProto\Settings\Logger;

class TelegramService
{
    private $madeline;

    public function __construct()
    {
        if (!Storage::exists('telegram')) {
            Storage::makeDirectory('telegram');
        }

        $sessionPath = Storage::path('telegram/session.madeline');

        $settings = new Settings;

        $settings->getLogger()
            ->setType(Logger::FILE_LOGGER)
            ->setExtra(storage_path('logs/madelineproto/madeline.log'));

        $this->madeline = new API($sessionPath, $settings);
        $this->madeline->start();
    }

    public function checkGroup(Request $request)
    {
        try {
            $group = $this->madeline->getPwrChat($request->username);

            return [
                'exists' => true,
                'group' => [
                    'id' => $group['id'],
                    'title' => $group['title'],
                    'username' => $group['username'] ?? null,
                    'members_count' => $group['participants_count'] ?? null
                ]
            ];
        } catch (\Exception $e) {
            return [
                'exists' => false,
                'error' => 'Группа не найдена или недоступна'
            ];
        }
    }
}
