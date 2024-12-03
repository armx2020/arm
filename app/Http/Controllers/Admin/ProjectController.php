<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\ProjectAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\ProjectRequest;
use App\Models\Company;
use App\Models\Group;
use App\Models\Project;
use App\Models\User;

class ProjectController extends BaseAdminController
{
    public function __construct(private ProjectAction $projectAction)
    {
        parent::__construct();
        $this->projectAction = $projectAction;
    }

    public function index()
    {
        return view('admin.project.index', ['menu' => $this->menu]);
    }

    public function create()
    {
        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.project.create', [
            'users' => $users,
            'companies' => $companies,
            'groups' => $groups,
            'menu' => $this->menu
        ]);
    }

    public function store(ProjectRequest $request)
    {
        $this->projectAction->store($request);

        return redirect()->route('admin.project.index')->with('success', 'Проект сохранен');
    }

    public function show(string $id)
    {
        $project = Project::with('parent')->find($id);

        if (empty($project)) {
            return redirect()->route('admin.project.index')->with('alert', 'Проект не найден');
        }

        return view('admin.project.edit', ['project' => $project, 'menu' => $this->menu]);
    }

    public function edit(string $id)
    {
        $project = Project::with('parent')->find($id);

        if (empty($project)) {
            return redirect()->route('admin.project.index')->with('alert', 'Проект не найден');
        }

        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.project.edit', [
            'project' => $project,
            'users' => $users,
            'companies' => $companies,
            'groups' => $groups,
            'menu' => $this->menu
        ]);
    }

    public function update(ProjectRequest $request, string $id)
    {
        $project = Project::find($id);

        if (empty($project)) {
            return redirect()->route('admin.project.index')->with('alert', 'Проект не найден');
        }

        $project = $this->projectAction->update($request, $project);

        return redirect()->route('admin.project.edit', ['project' => $project->id])->with('success', 'Проект сохранен');
    }

    public function destroy(string $id)
    {
        $project = Project::with('parent')->find($id);

        if (empty($project)) {
            return redirect()->route('admin.project.index')->with('alert', 'Проект не найден');
        }

        $project->delete();

        return redirect()->route('admin.project.index')->with('success', 'Проект удален');
    }
}
