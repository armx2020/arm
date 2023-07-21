<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Resume;
use Illuminate\Http\Request;

class ExperienceController extends Controller
{
    public function index()
    {
        $experiences = Experience::with('resume')->latest()->paginate(20);

        return view('admin.experience.index', ['experiences'=>$experiences]);
    }

    public function create()
    {
        $resumes = Resume::all();

        return view('admin.experience.create', ['resumes' => $resumes]);
    }

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

    public function show(string $id)
    {
        $experience = Experience::findOrFail($id);

        return view('admin.experience.show', ['experience' => $experience]);
    }

    public function edit(string $id)
    {
        $experience = Experience::findOrFail($id);
        $resumes = Resume::all();

        return view('admin.experience.edit', ['experience' => $experience, 'resumes' => $resumes]);
    }

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

    public function destroy(string $id)
    {
        $experience = Experience::findOrFail($id);
        $experience->delete();

        return redirect()->route('admin.experience.index')->with('success', 'The experience deleted');
    }
}
