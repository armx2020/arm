<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\VacancyRequest;
use App\Models\Company;
use App\Models\Group;
use App\Models\User;
use App\Models\Vacancy;
use App\Services\VacancyService;

class VacancyController extends Controller
{
    public function __construct(private VacancyService $vacancyService)
    {
        $this->vacancyService = $vacancyService;
    }

    public function index()
    {
        $vacancies = Vacancy::with('parent')->latest()->paginate(20);
        return view('admin.vacancy.index', ['vacancies' => $vacancies]);
    }

    public function create()
    {
        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.vacancy.create', [
                                        'users' => $users,
                                        'companies' => $companies,
                                        'groups' => $groups
        ]);
    }

    public function store(VacancyRequest $request)
    {
        $this->vacancyService->store($request);

        return redirect()->route('admin.vacancy.index')->with('success', 'The vacancy added');
    }

    public function show(string $id)
    {
        $vacancy = Vacancy::with('parent')->find($id);

        if(empty($vacancy)) {
            return redirect()->route('admin.vacancy.index')->with('alert', 'The vacancy not found');
        }

        return view('admin.vacancy.show', ['vacancy' => $vacancy]);
    }

    public function edit(string $id)
    {
        $vacancy = Vacancy::find($id);

        if(empty($vacancy)) {
            return redirect()->route('admin.vacancy.index')->with('alert', 'The vacancy not found');
        }

        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.vacancy.edit', [
                        'vacancy' => $vacancy,
                        'users' => $users,
                        'companies' => $companies,
                        'groups' => $groups
                        ]);
    }

    public function update(VacancyRequest $request, string $id)
    {
        $vacancy = Vacancy::find($id);

        if(empty($vacancy)) {
            return redirect()->route('admin.vacancy.index')->with('alert', 'The vacancy not found');
        }

        $this->vacancyService->update($request, $vacancy);       

        return redirect()->route('admin.vacancy.index')->with('success', 'The vacancy updated');
    }

    public function destroy(string $id)
    {
        $vacancy = Vacancy::find($id);

        if(empty($vacancy)) {
            return redirect()->route('admin.vacancy.index')->with('alert', 'The vacancy not found');
        }

        $vacancy->delete();

        return redirect()->route('admin.vacancy.index')->with('success', 'The vacancy deleted');
    }
}
