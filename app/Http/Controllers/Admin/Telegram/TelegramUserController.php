<?php

namespace App\Http\Controllers\Admin\Telegram;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Models\TelegramUser;

class TelegramUserController extends BaseAdminController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        return view('admin.telegram.telegram-user.index', ['menu' => $this->menu]);
    }

    public function destroy(TelegramUser $telegram_user)
    {
        $telegram_user->delete();

        return redirect()->route('admin.telegram_user.index')->with('success', 'Телеграмм-пользователь удален');
    }
}
