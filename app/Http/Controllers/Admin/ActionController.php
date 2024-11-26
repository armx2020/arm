<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\ActionRequest;
use App\Http\Requests\CategoryRequest;
use App\Models\Action;
use App\Models\Category;
use App\Services\ActionService;

class ActionController extends BaseAdminController
{
    public function __construct(private ActionService $actionService)
    {
        parent::__construct();
        $this->actionService = $actionService;
    }

    public function index()
    {
        return view('admin.action.index', ['menu' => $this->menu]);
    }

    public function create()
    {
        return view(
            'admin.action.create',
            [
                'menu' => $this->menu
            ]
        );
    }

    public function store(ActionRequest $request)
    {
        $this->actionService->store($request);

        return redirect()->route('admin.action.index')->with('success', 'Направление добавлено');
    }

    public function show(string $id)
    {
        $action = Action::withcount('companies')->find($id);

        if (empty($action)) {
            return redirect()->route('admin.action.index')->with('alert', 'Направление не найдено');
        }

        return view('admin.action.edit', ['action' => $action, 'menu' => $this->menu]);
    }

    public function edit(string $id)
    {
        $action = Action::find($id);

        if (empty($action)) {
            return redirect()->route('admin.action.index')->with('alert', 'Направление не найдено');
        }

        return view('admin.action.edit', [
            'action' => $action,
            'menu' => $this->menu
        ]);
    }

    public function update(ActionRequest $request, string $id)
    {
        $action = Action::find($id);

        if (empty($action)) {
            return redirect()->route('admin.action.index')->with('alert', 'Направление не найдено');
        }

        $action = $this->actionService->update($request, $action);

        return redirect()->route('admin.action.edit', ['action' => $action->id])
            ->with('success', 'Направление сохранено');
    }


    public function destroy(string $id)
    {
        $action = Category::find($id);

        if (empty($action)) {
            return redirect()->route('admin.action.index')->with('alert', 'Направление не найдено');
        }

        $action->delete();

        return redirect()->route('admin.action.index')->with('success', 'Направление удалено');
    }
}
