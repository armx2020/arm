<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
use App\Models\Group;
use App\Models\Project;
use App\Models\User;
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
        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.project.create', [
                                        'users' => $users,
                                        'companies' => $companies,
                                        'groups' => $groups
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
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
        
        if ($request->parent == 'User') {
            $project->parent_type = 'App\Models\User';
            $project->parent_id = $request->user;
        } elseif ($request->parent == 'Company') {
            $project->parent_type = 'App\Models\Company';
            $project->parent_id = $request->company;
        } elseif ($request->parent == 'Group') {
            $project->parent_type = 'App\Models\Group';
            $project->parent_id = $request->group;
        } else {
            $project->parent_type = 'App\Models\Admin';
            $project->parent_id = 1;
        }

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

        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.project.edit', [
                    'project' => $project,
                    'users' => $users,
                    'companies' => $companies,
                    'groups' => $groups
        ]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
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

        if ($request->parent == 'User') {
            $project->parent_type = 'App\Models\User';
            $project->parent_id = $request->user;
        } elseif ($request->parent == 'Company') {
            $project->parent_type = 'App\Models\Company';
            $project->parent_id = $request->company;
        } elseif ($request->parent == 'Group') {
            $project->parent_type = 'App\Models\Group';
            $project->parent_id = $request->group;
        } else {
            $project->parent_type = 'App\Models\Admin';
            $project->parent_id = 1;
        }


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
