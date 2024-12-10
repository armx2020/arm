<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\WorkAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\Work\StoreWorkRequest;
use App\Http\Requests\Work\UpdateWorkRequest;
use App\Models\Company;
use App\Models\Group;
use App\Models\User;
use App\Models\Work;


class WorkController extends BaseAdminController
{
    public function __construct(private WorkAction $workAction)
    {
        parent::__construct();
        $this->workAction = $workAction;
    }

    public function index()
    {
        return view('admin.work.index', ['menu' => $this->menu]);
    }

    public function create()
    {
        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.work.create', [
            'users' => $users,
            'companies' => $companies,
            'groups' => $groups,
            'menu' => $this->menu
        ]);
    }

    public function store(StoreWorkRequest $request)
    {
        $this->workAction->store($request);

        return redirect()->route('admin.work.index')->with('success', 'Работа сохранена');
    }

    public function edit(string $id)
    {
        $work = Work::find($id);

        if (empty($work)) {
            return redirect()->route('admin.work.index')->with('alert', 'Работа не найдена');
        }

        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.work.edit', [
            'work' => $work,
            'users' => $users,
            'companies' => $companies,
            'groups' => $groups,
            'menu' => $this->menu
        ]);
    }

    public function update(UpdateWorkRequest $request, string $id)
    {
        $work = Work::find($id);

        if (empty($work)) {
            return redirect()->route('admin.work.index')->with('alert', 'Работа не найдена');
        }

        $work = $this->workAction->update($request, $work);

        return redirect()->route('admin.work.edit', ['work' => $work->id])->with('success', 'Работа сохранена');
    }

    public function destroy(string $id)
    {
        $work = Work::find($id);

        if (empty($work)) {
            return redirect()->route('admin.work.index')->with('alert', 'Работа не найдена');
        }

        $work->delete();

        return redirect()->route('admin.work.index')->with('success', 'Работа удалена');
    }
}