<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Resume;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $experiences = Experience::with('resume')->latest()->paginate(20);

        return view('admin.experience.index', ['experiences'=>$experiences]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $resumes = Resume::all();

        return view('admin.experience.create', ['resumes' => $resumes]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'description' => ['string'],
        ]);

        $experience = new Experience();

        $experience->name = $request->name;
        $experience->description = $request->description;
        $experience->start_worktime = $request->start_worktime;
        $experience->end_worktime = $request->end_worktime;
        $experience->resume_id = $request->resume_id;

        $experience->save();

        return redirect()->route('admin.experience.index')->with('success', 'The experience added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $experience = Experience::findOrFail($id);

        return view('admin.experience.show', ['experience' => $experience]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $experience = Experience::findOrFail($id);
        $resumes = Resume::all();

        return view('admin.experience.edit', ['experience' => $experience, 'resumes' => $resumes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'description' => ['string'],
        ]);

        $experience = Experience::findOrFail($id);

        $experience->name = $request->name;
        $experience->description = $request->description;
        $experience->start_worktime = $request->start_worktime;
        $experience->end_worktime = $request->end_worktime;
        $experience->resume_id = $request->resume_id;

        $experience->update();

        return redirect()->route('admin.experience.index')->with('success', 'The experience saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $experience = Experience::findOrFail($id);
        $experience->delete();

        return redirect()->route('admin.experience.index')->with('success', 'The experience deleted');
    }
}
