<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\ProjectRequest;
use App\Models\Company;
use App\Models\Group;
use App\Models\Project;
use App\Models\User;
use App\Services\ProjectService;

class ProjectController extends BaseAdminController
{
    public function __construct(private ProjectService $projectService)
    {
        parent::__construct();
        $this->projectService = $projectService;
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
        $this->projectService->store($request);

        return redirect()->route('admin.project.index')->with('success', 'The project added');
    }

    public function show(string $id)
    {
        $project = Project::with('parent')->find($id);

        if (empty($project)) {
            return redirect()->route('admin.project.index')->with('alert', 'The event not found');
        }

        return view('admin.project.edit', ['project' => $project, 'menu' => $this->menu]);
    }

    public function edit(string $id)
    {
        $project = Project::with('parent')->find($id);

        if (empty($project)) {
            return redirect()->route('admin.project.index')->with('alert', 'The event not found');
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
            return redirect()->route('admin.project.index')->with('alert', 'The event not found');
        }

        $project = $this->projectService->update($request, $project);

        return redirect()->route('admin.project.index')->with('success', 'The project updated');
    }

    public function destroy(string $id)
    {
        $project = Project::with('parent')->find($id);

        if (empty($project)) {
            return redirect()->route('admin.project.index')->with('alert', 'The event no found');
        }

        $project->delete();

        return redirect()->route('admin.project.index')->with('success', 'The project deleted');
    }
}
