<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ResumeRequest;
use App\Models\Resume;
use App\Models\User;
use App\Services\ResumeService;

class ResumeController extends Controller
{
    public function __construct(private ResumeService $resumeService)
    {
        $this->resumeService = $resumeService;
    }

    public function index()
    {
        return view('admin.resume.index');
    }

    public function create()
    {
        $users = User::all();
        return view('admin.resume.create', ['users' => $users]);
    }

    public function store(ResumeRequest $request)
    {
        $this->resumeService->store($request);

        return redirect()->route('admin.resume.index')->with('success', 'The resume added');
    }

    public function show(string $id)
    {
        $resume = Resume::with('user')->find($id);

        if(empty($resume)) {
            return redirect()->route('admin.resume.index')->with('alert', 'The resume not found');
        }

        return view('admin.resume.show', ['resume' => $resume]);
    }

    public function edit(string $id)
    {
        $resume = Resume::find($id);

        if(empty($resume)) {
            return redirect()->route('admin.resume.index')->with('alert', 'The resume not found');
        }

        $users = User::all();
        
        return view('admin.resume.edit', ['resume' => $resume, 'users' => $users]);
    }

    public function update(ResumeRequest $request, string $id)
    {
        $resume = Resume::find($id);

        if(empty($resume)) {
            return redirect()->route('admin.resume.index')->with('alert', 'The resume not found');
        }

        $resume = $this->resumeService->update($request, $resume);

        return redirect()->route('admin.resume.index')->with('success', 'The resume updated');
    }

    public function destroy(string $id)
    {
        $resume = Resume::find($id);

        if(empty($resume)) {
            return redirect()->route('admin.resume.index')->with('alert', 'The resume not found');
        }
        
        $resume->delete();

        return redirect()->route('admin.resume.index')->with('success', 'The resume deleted');
    }
}
