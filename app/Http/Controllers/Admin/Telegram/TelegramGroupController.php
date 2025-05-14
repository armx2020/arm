<?php

namespace App\Http\Controllers\Admin\Telegram;

use App\Entity\Actions\Admin\Telegram\TelegramGroupAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Admin\Telegram\TelegramGroupRequest;
use App\Models\Category;
use App\Models\TelegramGroup;
use App\Services\TelegramService;

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
        $telegramService = new TelegramService;

        $newGroup = $telegramService->checkGroup($request);

        if ($newGroup['exists']) {
            $telegramGroup = TelegramGroup::updateOrCreate(
                ['id' => $newGroup['group']['id']],
                [
                    'username' => $newGroup['group']['username'] ?? null,
                    'title' => $newGroup['group']['title'],
                    'description' => $newGroup['group']['about'] ?? null,
                ]
            );
            return redirect()->route('admin.telegram_group.index')->with('success', 'Телеграмм-группа добавлена');
        } else {
            return redirect()->route('admin.telegram_group.create')->with('success', $newGroup['error']);
        }
    }

    public function edit(TelegramGroup $telegram_group)
    {
        return view('admin.telegram.telegram-group.edit', ['menu' => $this->menu, 'entity' => $telegram_group]);
    }

    public function update(TelegramGroupRequest $request, TelegramGroup $telegram_group)
    {
        $telegramService = new TelegramService;

        $newGroup = $telegramService->checkGroup($request);

        if ($newGroup['exists']) {
            $telegramGroup = TelegramGroup::updateOrCreate(
                ['id' => $newGroup['group']['id']],
                [
                    'username' => $newGroup['group']['username'] ?? null,
                    'title' => $newGroup['group']['title'],
                    'description' => $newGroup['group']['about'] ?? null,
                ]
            );
            return redirect()->route('admin.telegram_group.index')->with('success', 'Телеграмм-группа сохранена');
        } else {
            return redirect()->route('admin.telegram_group.edit', ['telegram_group' => $telegram_group->id])->with('success', $newGroup['error']);
        }
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.telegram_group.index')->with('success', 'Телеграмм-группа удалена');
    }
}
