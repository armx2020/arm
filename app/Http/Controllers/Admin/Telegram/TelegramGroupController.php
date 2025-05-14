<?php

namespace App\Http\Controllers\Admin\Telegram;

use App\Entity\Actions\Admin\Telegram\TelegramGroupAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\Telegram\TelegramGroupRequest;
use App\Models\Category;
use App\Models\TelegramGroup;
use Illuminate\Support\Facades\Http;

class TelegramGroupController extends BaseAdminController
{
    public function __construct(private TelegramGroupAction $telegram_group_action)
    {
        parent::__construct();
        $this->telegram_group_action = $telegram_group_action;
    }

    public function index()
    {
        return view('admin.telegram.telegram-group.index', ['menu' => $this->menu]);
    }

    public function create()
    {
        return view('admin.telegram.telegram-group.create', ['menu' => $this->menu]);
    }

    public function store(TelegramGroupRequest $request)
    {
        $newGroup = $this->checkGroup($request->username);

        if ($newGroup) {
            $telegram_group = TelegramGroup::where('username', $request->username)->First();

            if ($telegram_group) {
                return redirect()->route('admin.telegram_group.create')->with('success', 'группа c таким названием уже есть в списке');
            } else {
                $telegram_group = TelegramGroup::create([
                    'id' => rand(88888, 999999999),
                    'username' => $request->username,
                    'title' => 'не проверено'
                ]);
            }
            return redirect()->route('admin.telegram_group.index')->with('success', 'Телеграмм-группа добавлена');
        } else {
            return redirect()->route('admin.telegram_group.create')->with('success', 'Группы с таким названием не существует');
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.telegram_group.index')->with('success', 'Телеграмм-группа удалена');
    }

    public function checkGroup($username)
    {
        $response = Http::withoutRedirecting()
            ->get("https://t.me/$username");

        if ($response->status() === 200) {
            return true; // Группа существует
        }

        return false; // Группа не найдена (status 404)
    }
}
