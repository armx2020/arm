<?php

namespace App\Http\Controllers\Admin\Telegram;

use App\Entity\Actions\Admin\Telegram\TelegramGroupAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Category\StoreCategoryRequest;
use App\Http\Requests\Category\UpdateCategoryRequest;
use App\Models\Category;

class TelegramMessageController extends BaseAdminController
{
    public function __construct(private TelegramGroupAction $telegram_group_action)
    {
        parent::__construct();
        $this->telegram_group_action = $telegram_group_action;
    }

    public function index()
    {
        return view('admin.category.index', ['menu' => $this->menu]);
    }

    public function create()
    {
        return view('admin.category.create', ['menu' => $this->menu]);
    }

    public function store(StoreCategoryRequest $request)
    {
        $this->telegram_group_action->store($request);

        return redirect()->route('admin.category.index')->with('success', 'Категория добавлена');
    }

    public function edit(Category $category)
    {
        return view('admin.category.edit', ['menu' => $this->menu, 'category' => $category]);
    }

    public function update(UpdateCategoryRequest $request, Category $category)
    {
        $category = $this->telegram_group_action->update($request, $category);

        return redirect()->route('admin.category.edit', ['category' => $category->id])
            ->with('success', 'Категория сохранена');
    }


    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.category.index')->with('success', 'Категория удалена');
    }
}
