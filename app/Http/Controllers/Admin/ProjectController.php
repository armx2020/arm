<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    public function index()
    {
       return view('admin.project.index');
    }

    public function create()
    {
        return view('admin.project.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:128'],
            'image' => ['image', 'max:2048'],
        ]);

        $project = new Project();

        $city = City::with('region')->findOrFail($request->city);

        $project->name = $request->name;
        $project->address = $request->address;
        $project->description = $request->description;
        $project->city_id = $request->city;
        $project->region_id = $city->region->id; // add to region key
        $project->donations_need = $request->donations_need;
        $project->donations_have = $request->donations_have;
        $project->parent_type = 'App\Models\Admin';
        $project->parent_id = 1;

        if ($request->image) {
            $project->image = $request->file('image')->store('projects', 'public');
        }

        $project->save();
        
        return redirect()->route('admin.project.index')->with('success', 'The project added');
    }

    public function show(string $id)
    {
        $project = Project::with('parent')->findOrFail($id);

        return view('admin.project.show', ['project' => $project]);
    }

    public function edit(string $id)
    {
        $project = Project::with('parent')->findOrFail($id);

        return view('admin.project.edit', ['project' => $project]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:128'],
            'image' => ['image', 'max:2048'],
        ]);

        $city = City::with('region')->findOrFail($request->city);

        $project = Project::findOrFail($id);

        $project->name = $request->name;
        $project->address = $request->address;
        $project->description = $request->description;
        $project->city_id = $request->city;
        $project->region_id = $city->region->id; // add to region key
        $project->donations_need = $request->donations_need;
        $project->donations_have = $request->donations_have;

        if ($request->image) {
            Storage::delete('public/'.$project->image);
            $project->image = $request->file('image')->store('projects', 'public');
        }

        $project->save();


        return redirect()->route('admin.project.index')->with('success', 'The project saved');
    }

    public function destroy(string $id)
    {
        $project = Project::with('parent')->findOrFail($id);
        $project->delete();

        return redirect()->route('admin.project.index')->with('success', 'The project deleted');
    }
}
