<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Vacancy;
use Illuminate\Http\Request;

class VacancyController extends Controller
{

    public function index()
    {
        $vacancies = Vacancy::with('parent')->latest()->paginate(20);
        return view('admin.vacancy.index', ['vacancies' => $vacancies]);
    }

    public function create()
    {
        return view('admin.vacancy.create');
    }

    public function store(Request $request)
    {
         $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:128'],
            'image' => ['image', 'max:2048'],
        ]);

        $city = City::with('region')->findOrFail($request->city);

        $vacancy = new Vacancy();

        $vacancy->name = $request->name;
        $vacancy->address = $request->address;
        $vacancy->description = $request->description;
        $vacancy->price = $request->price;
        $vacancy->parent_type = 'App\Models\Admin';
        $vacancy->parent_id = 1;
        $vacancy->city_id = $request->city;
        $vacancy->region_id = $city->region->id; // add to region key

        $vacancy->save();

        return redirect()->route('admin.vacancy.index')->with('success', 'The vacancy added');
    }

    public function show(string $id)
    {
        $vacancy = Vacancy::with('parent')->findOrFail($id);
        return view('admin.vacancy.show', ['vacancy' => $vacancy]);
    }

    public function edit(string $id)
    {
        $vacancy = Vacancy::findOrFail($id);
        return view('admin.vacancy.edit', ['vacancy' => $vacancy]);
    }


    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:128'],
        ]);

        
        $vacancy = Vacancy::findOrFail($id);

        $city = City::with('region')->findOrFail($request->city);

        $vacancy->name = $request->name;
        $vacancy->address = $request->address;
        $vacancy->description = $request->description;
        $vacancy->price = $request->price;
        $vacancy->city_id = $request->city;
        $vacancy->region_id = $city->region->id; // add to region key

        $vacancy->update();

        return redirect()->route('admin.vacancy.index')->with('success', 'The vacancy saved');

    }


    public function destroy(string $id)
    {
        $vacancy = Vacancy::findOrFail($id);
        $vacancy->delete();

        return redirect()->route('admin.vacancy.index')->with('success', 'The vacancy deleted');
    }
}
