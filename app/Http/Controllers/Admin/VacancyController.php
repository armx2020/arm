<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Group;
use App\Models\User;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vacancies = Vacancy::with('parent')->latest()->paginate(20);

        return view('admin.vacancy.index', ['vacancies' => $vacancies]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return redirect()->route('admin.vacancy.index');
        // $users = User::all();
        // $companies = Company::all();
        // $groups = Group::all();

        // return view('admin.vacancy.create', [
        //     'users' => $users,
        //     'companies' => $companies,
        //     'groups' => $groups
        // ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        return redirect()->route('admin.vacancy.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vacancy = Vacancy::with('parent')->findOrFail($id);
        return view('admin.vacancy.show', ['vacancy' => $vacancy]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $vacancy = Vacancy::findOrFail($id);
        return view('admin.vacancy.edit', ['vacancy' => $vacancy]);
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

        
        $vacancy = Vacancy::findOrFail($id);

        $vacancy->name = $request->name;
        $vacancy->address = $request->address;
        $vacancy->description = $request->description;
        $vacancy->price = $request->price;

        $vacancy->update();

        return redirect()->route('admin.vacancy.index')->with('success', 'The vacancy saved');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $vacancy = Vacancy::findOrFail($id);
        $vacancy->delete();

        return redirect()->route('admin.vacancy.index')->with('success', 'The vacancy deleted');
    }
}
