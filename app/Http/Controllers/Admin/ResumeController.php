<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\ResumeAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\ResumeRequest;
use App\Models\User;
use App\Models\Work;


class ResumeController extends BaseAdminController
{
    public function __construct(private ResumeAction $resumeAction)
    {
        parent::__construct();
        $this->resumeAction = $resumeAction;
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
        $this->resumeAction->store($request);

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

        $resume = $this->resumeAction->update($request, $resume);

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
