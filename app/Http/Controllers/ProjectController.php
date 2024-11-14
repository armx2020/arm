<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        return view('pages.project.projects', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
        ]);
    }

    public function show(Request $request, $id)
    {
        $project = Project::with('parent')->find($id);

        if (empty($project)) {
            return redirect()->route('projects.index')->with('alert', 'Проект не найден');
        }

        if ($project->donations_have > 0 && $project->donations_need > 0) {
            $fullness = (round(($project->donations_have * 100) / $project->donations_need));
        } else {
            $fullness = 0;
        }

        return view('pages.project.project', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'project' => $project,
            'fullness' => $fullness,
        ]);
    }
}
