<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\BaseController;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request, $regionCode = null)
    {
        return view('pages.project.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $regionCode
        ]);
    }

    public function show(Request $request, $id)
    {
        $project = Project::with('parent')->find($id);

        if (empty($project)) {
            return redirect()->route('projects.index')->with('alert', 'Проект не найден');
        }

        

        return view('pages.project.show', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'entity' => $project,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }
}
