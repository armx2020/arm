<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
use App\Models\Group;
use App\Models\User;
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
        $users = User::all();
        $companies = Company::all();
        $groups = Group::all();

        return view('admin.vacancy.create', [
                                        'users' => $users,
                                        'companies' => $companies,
                                        'groups' => $groups
        ]);
    }

    public function store(Request $request)
    {
         $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
            'image' => ['image', 'max:2048'],
        ]);

        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $vacancy = new Vacancy();

        $vacancy->name = $request->name;
        $vacancy->address = $request->address;
        $vacancy->description = $request->description;
        $vacancy->price = $request->price;
        $vacancy->city_id = $request->city;
        $vacancy->region_id = $city->region->id; // add to region key

        if ($request->parent == 'User') {
            $vacancy->parent_type = 'App\Models\User';
            $vacancy->parent_id = $request->user;
        } elseif ($request->parent == 'Company') {
            $vacancy->parent_type = 'App\Models\Company';
            $vacancy->parent_id = $request->company;
        } elseif ($request->parent == 'Group') {
            $vacancy->parent_type = 'App\Models\Group';
            $vacancy->parent_id = $request->group;
        } else {
            $vacancy->parent_type = 'App\Models\Admin';
            $vacancy->parent_id = 1;
        }

        $vacancy->save();

        return redirect()->route('admin.vacancy.index')->with('success', 'The vacancy added');
    }

    public function show(string $id)
    {
        $vacancy = Vacancy::with('parent')->find($id);

        if(empty($vacancy)) {
            return redirect()->route('admin.vacancy.index')->with('alert', 'The vacancy no finded');
        }

        return view('admin.vacancy.show', ['vacancy' => $vacancy]);
    }

    public function edit(string $id)
    {
        $vacancy = Vacancy::find($id);

        if(empty($vacancy)) {
            return redirect()->route('admin.vacancy.index')->with('alert', 'The vacancy no finded');
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

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
        ]);

        
        $vacancy = Vacancy::find($id);

        if(empty($vacancy)) {
            return redirect()->route('admin.vacancy.index')->with('alert', 'The vacancy no finded');
        }

        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $vacancy->name = $request->name;
        $vacancy->address = $request->address;
        $vacancy->description = $request->description;
        $vacancy->price = $request->price;
        $vacancy->city_id = $request->city;
        $vacancy->region_id = $city->region->id; // add to region key

        if ($request->parent == 'User') {
            $vacancy->parent_type = 'App\Models\User';
            $vacancy->parent_id = $request->user;
        } elseif ($request->parent == 'Company') {
            $vacancy->parent_type = 'App\Models\Company';
            $vacancy->parent_id = $request->company;
        } elseif ($request->parent == 'Group') {
            $vacancy->parent_type = 'App\Models\Group';
            $vacancy->parent_id = $request->group;
        } else {
            $vacancy->parent_type = 'App\Models\Admin';
            $vacancy->parent_id = 1;
        }

        $vacancy->update();

        return redirect()->route('admin.vacancy.index')->with('success', 'The vacancy saved');
    }

    public function destroy(string $id)
    {
        $vacancy = Vacancy::find($id);

        if(empty($vacancy)) {
            return redirect()->route('admin.vacancy.index')->with('alert', 'The vacancy no finded');
        }

        $vacancy->delete();

        return redirect()->route('admin.vacancy.index')->with('success', 'The vacancy deleted');
    }
}
