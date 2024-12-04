<?php

namespace App\Http\Controllers\Admin;

use App\Entity\Actions\VacancyAction;
use App\Http\Controllers\Admin\BaseAdminController;
use App\Http\Requests\VacancyRequest;
use App\Models\Company;
use App\Models\Group;
use App\Models\User;
use App\Models\Work;

class VacancyController extends BaseAdminController
{
    public function __construct(private VacancyAction $vacancyAction)
    {
        parent::__construct();
        $this->vacancyAction = $vacancyAction;
    }

    public function index()
    {
        //        $vacancies = Work::vacancy()->with('parent')->latest()->paginate(20);
        //        return view('admin.vacancy.index', ['vacancies' => $vacancies, 'menu' => $this->menu]);
        abort(404);
    }

    public function create()
    {
        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.vacancy.create', [
            'users' => $users,
            'companies' => $companies,
            'groups' => $groups,
            'menu' => $this->menu
        ]);
    }

    public function store(VacancyRequest $request)
    {
        $this->vacancyAction->store($request);

        return redirect()->route('admin.vacancy.index')->with('success', 'Вакансия добавлена');
    }

    public function show(string $id)
    {
        $vacancy = Work::vacancy()->with('parent')->find($id);

        if (empty($vacancy)) {
            return redirect()->route('admin.vacancy.index')->with('alert', 'Вакансия не найдена');
        }

        return view('admin.vacancy.edit', ['vacancy' => $vacancy, 'menu' => $this->menu]);
    }

    public function edit(string $id)
    {
        $vacancy = Work::find($id);

        if (empty($vacancy)) {
            return redirect()->route('admin.vacancy.index')->with('alert', 'Вакансия не найдена');
        }

        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.vacancy.edit', [
            'vacancy' => $vacancy,
            'users' => $users,
            'companies' => $companies,
            'groups' => $groups,
            'menu' => $this->menu
        ]);
    }

    public function update(VacancyRequest $request, string $id)
    {
        $vacancy = Work::find($id);

        if (empty($vacancy)) {
            return redirect()->route('admin.vacancy.index')->with('alert', 'Вакансия не найдена');
        }

        $vacancy = $this->vacancyAction->update($request, $vacancy);

        return redirect()->route('admin.vacancy.edit', ['vacancy' => $vacancy->id])->with('success', 'Вакансия сохранена');
    }

    public function destroy(string $id)
    {
        $vacancy = Work::find($id);

        if (empty($vacancy)) {
            return redirect()->route('admin.vacancy.index')->with('alert', 'Вакансия не найдена');
        }

        $vacancy->delete();

        return redirect()->route('admin.vacancy.index')->with('success', 'Вакансия удалена');
    }
}
