<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Experience;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $resumes = Resume::with('user', 'experiences')->latest()->paginate(20);

        return view('admin.resume.index', ['resumes' => $resumes]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::all();

        return view('admin.resume.create', ['users' => $users]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:128'],
            'description' => ['string'],
        ]);

        $resume = new Resume();

        $resume->name = $request->name;
        $resume->address = $request->address;
        $resume->description = $request->description;
        $resume->price = $request->price;
        $resume->user_id = $request->user;

        $resume->save();

        return redirect()->route('admin.resume.index')->with('success', 'The resume added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $resume = Resume::with('user', 'experiences')->findOrFail($id);

        return view('admin.resume.show', ['resume' => $resume]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $resume = Resume::findOrFail($id);
        $users = User::all();
        $experiences = Experience::all();
        
        return view('admin.resume.edit', ['resume'=>$resume, 'users'=>$users, 'experiences'=>$experiences]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:128'],
            'description' => ['string'],
        ]);

        $resume = Resume::findOrFail($id);

        $resume->name = $request->name;
        $resume->address = $request->address;
        $resume->description = $request->description;
        $resume->price = $request->price;
        $resume->user_id = $request->user;

        $resume->update();

        return redirect()->route('admin.resume.index')->with('success', 'The resume saved');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $resume = Resume::findOrFail($id);
        $resume->delete();

        return redirect()->route('admin.resume.index')->with('success', 'The resume deleted');
    }
}
