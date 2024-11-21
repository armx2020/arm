<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\ResumeRequest;
use App\Models\User;
use App\Models\Work;
use App\Services\ResumeService;

class ResumeController extends BaseAdminController
{
    public function __construct(private ResumeService $resumeService)
    {
        parent::__construct();
        $this->resumeService = $resumeService;
    }

    public function index()
    {
        return view('admin.resume.index', ['menu' => $this->menu]);
    }

    public function create()
    {
        $users = User::all();
        return view('admin.resume.create', ['users' => $users, 'menu' => $this->menu]);
    }

    public function store(ResumeRequest $request)
    {
        $this->resumeService->store($request);

        return redirect()->route('admin.resume.index')->with('success', 'Резюме сохранено');
    }

    public function show(string $id)
    {
        $resume = Work::resume()->with('parent')->find($id);

        if(empty($resume)) {
            return redirect()->route('admin.resume.index')->with('alert', 'Резюме не найдено');
        }

        return view('admin.resume.edit', ['resume' => $resume, 'menu' => $this->menu]);
    }

    public function edit(string $id)
    {
        $resume = Work::find($id);

        if(empty($resume)) {
            return redirect()->route('admin.resume.index')->with('alert', 'Резюме не найдено');
        }

        $users = User::all();
        
        return view('admin.resume.edit', ['resume' => $resume, 'users' => $users, 'menu' => $this->menu]);
    }

    public function update(ResumeRequest $request, string $id)
    {
        $resume = Work::find($id);

        if(empty($resume)) {
            return redirect()->route('admin.resume.index')->with('alert', 'Резюме не найдено');
        }

        $resume = $this->resumeService->update($request, $resume);

        return redirect()->route('admin.resume.edit', ['resume' => $resume->id])->with('success', 'Резюме сохранено');
    }

    public function destroy(string $id)
    {
        $resume = Work::find($id);

        if(empty($resume)) {
            return redirect()->route('admin.resume.index')->with('alert', 'Резюме не найдено');
        }
        
        $resume->delete();

        return redirect()->route('admin.resume.index')->with('success', 'Резюме удалено');
    }
}
