<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProjectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $projects = Project::latest()->paginate();

       return view('admin.project.index', ['projects' => $projects]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.project.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:128'],
            'image' => ['image', 'max:2048'],
        ]);

        $project = new Project();

        $project->name = $request->name;
        $project->address = $request->address;
        $project->description = $request->description;
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

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $project = Project::with('parent')->findOrFail($id);

        return view('admin.project.show', ['project' => $project]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::with('parent')->findOrFail($id);

        return view('admin.project.edit', ['project' => $project]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:128'],
            'image' => ['image', 'max:2048'],
        ]);

        $project->name = $request->name;
        $project->address = $request->address;
        $project->description = $request->description;
        $project->donations_need = $request->donations_need;
        $project->donations_have = $request->donations_have;

        if ($request->image) {
            Storage::delete('public/'.$project->image);
            $project->image = $request->file('image')->store('projects', 'public');
        }

        $project->save();


        return redirect()->route('admin.project.index')->with('success', 'The project saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::with('parent')->findOrFail($id);
        $project->delete();

        return redirect()->route('admin.project.index')->with('success', 'The project deleted');
    }
}
