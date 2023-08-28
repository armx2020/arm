<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        return view('pages.project.projects', [
            'city'   => $request->session()->get('city'),
            'cities' => $cities
        ]);
    }

    public function show(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $project = Project::with('parent')->findOrFail($id);

        if (empty($project)) {
            return redirect()->route('projects.index')->with('alert', 'Проект не найден');
        }

        if ($project->donations_have > 0 && $project->donations_need > 0) {
            $fullness = (round(($project->donations_have * 100) / $project->donations_need));
        } else {
            $fullness = 0;
        }


        return view('pages.project.project', [
            'city'   => $request->session()->get('city'),
            'project' => $project,
            'fullness' => $fullness,
            'cities' => $cities
        ]);
    }
}
