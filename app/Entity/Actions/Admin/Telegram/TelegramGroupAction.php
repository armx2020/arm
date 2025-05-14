<?php

namespace App\Entity\Actions\Admin\Telegram;

use App\Models\TelegramGroup;

class TelegramGroupAction
{
    public function store($newGroup): TelegramGroup
    {
        $telegramGroup = TelegramGroup::updateOrCreate(
            ['id' => $newGroup['id']],
            [
                'username' => $newGroup['username'] ?? null,
                'title' => $newGroup['title'],
                'description' => $newGroup['about'] ?? null,
            ]
        );

        return $telegramGroup;
    }

    public function update($request, $telegramGroup): TelegramGroup
    {
        $telegramGroup->username = $request->username;

        $telegramGroup->update();

        return $telegramGroup;
    }

    public function destroy($telegramGroup)
    {
        $telegramGroup->telegram_messages()->delete();
        $telegramGroup->delete();
    }
}
