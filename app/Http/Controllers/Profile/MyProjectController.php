<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyProjectController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $projects = Auth::user()->projects;

        return view('profile.pages.project.index', [
            'city'   => $request->session()->get('city'),
            'projects' => $projects,
            'cities' => $cities
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
            'image' => ['image', 'max:2048'],
        ]);

        $city = City::with('region')->find($request->project_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $project = new Project();

        $project->name = $request->name;
        $project->address = $request->address;
        $project->description = $request->description;

        $project->donations_need = $request->donations_need;

        $project->city_id = $request->project_city;
        $project->region_id = $city->region->id;

        $project->parent_type = 'App\Models\User';
        $project->parent_id = Auth::user()->id;


        if ($request->image) {
            $project->image = $request->file('image')->store('projects', 'public');
        }

        $project->save();

        return redirect()->route('myproject.index')->with('success', 'Проект "' . $project->name . '" добавлена');
    }

    public function show(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $project = Project::where('parent_id', '=', Auth::user()->id)->where('parent_type', '=', 'App\Models\User')->find($id);

        if (empty($project)) {
            return redirect()->route('myproject.index')->with('alert', 'Проект не найден');
        }

        return view('profile.pages.project.show', [
            'city'   => $request->session()->get('city'),
            'project' => $project,
            'cities' => $cities
        ]);
    }

    public function edit(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $project = Project::where('parent_id', '=', Auth::user()->id)->where('parent_type', '=', 'App\Models\User')->find($id);

        if (empty($project)) {
            return redirect()->route('myproject.index')->with('alert', 'Проект не найден');
        }

        return view('profile.pages.project.edit', [
            'city'   => $request->session()->get('city'),
            'project' => $project,
            'cities' => $cities
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
            'image' => ['image', 'max:2048'],
        ]);

        $city = City::with('region')->find($request->project_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $project = Project::where('parent_id', '=', Auth::user()->id)->where('parent_type', '=', 'App\Models\User')->find($id);

        if (empty($project)) {
            return redirect()->route('myproject.index')->with('alert', 'Проект не найден');
        }

        $project->name = $request->name;
        $project->address = $request->address;
        $project->description = $request->description;

        $project->donations_need = $request->donations_need;
        $project->donations_have = $request->donations_have;

        $project->city_id = $request->project_city;
        $project->region_id = $city->region->id;

        $project->parent_type = 'App\Models\User';
        $project->parent_id = Auth::user()->id;

        if ($request->image) {
            Storage::delete('public/' . $project->image);
            $project->image = $request->file('image')->store('projects', 'public');
        }

        $project->update();

        return redirect()->route('myproject.show', ['id' => $project->id])->with('success', 'Проект "' . $project->name . '" обнавлен');
    }

    public function destroy($id)
    {
        $project = Project::where('parent_id', '=', Auth::user()->id)->where('parent_type', '=', 'App\Models\User')->find($id);

        if (empty($project)) {
            return redirect()->route('myproject.index')->with('alert', 'Проект не найден');
        }

        if ($project->image !== null) {
            Storage::delete('public/' . $project->image);
        }

        $project->delete();

        return redirect()->route('myproject.index')->with('success', 'Проект удален');
    }
}
