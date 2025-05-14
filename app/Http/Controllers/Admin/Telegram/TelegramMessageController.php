<?php

namespace App\Http\Controllers\Admin\Telegram;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Models\TelegramMessage;

class TelegramMessageController extends BaseAdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('admin.telegram.telegram-message.index', ['menu' => $this->menu]);
    }

    public function destroy(TelegramMessage $telegram_message)
    {
        $telegram_message->delete();

        return redirect()->route('admin.telegram_message.index')->with('success', 'Телеграмм-сообщение удален');
    }
}
