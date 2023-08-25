<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
use App\Models\Group;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyVacancyController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $vacancies = Auth::user()->vacancies;
        $groups = Group::where('user_id', '=', Auth::user()->id)->with('vacancies')->get();
        $companies = Company::where('user_id', '=', Auth::user()->id)->with('vacancies')->get();

        return view('profile.pages.vacancy.index', [
            'city'      => $request->session()->get('city'),
            'vacancies' => $vacancies,
            'groups'    => $groups,
            'companies' => $companies,
            'cities'    => $cities
        ]);
    }

    public function create(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $companies = Company::where('user_id', '=', Auth::user()->id)->get();
        $groups = Group::where('user_id', '=', Auth::user()->id)->get();

        return view('profile.pages.vacancy.create', [
            'city'      => $request->session()->get('city'),
            'companies' => $companies,
            'groups'    => $groups,
            'cities'    => $cities
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
        ]);

        $city = City::with('region')->find($request->vacancy_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $vacancy = new Vacancy();

        $vacancy->name = $request->name;
        $vacancy->address = $request->address;
        $vacancy->description = $request->description;
        $vacancy->price = $request->price;

        $vacancy->city_id = $request->vacancy_city;
        $vacancy->region_id = $city->region->id;

        $parent = $request->parent;
        $parent_explode = explode('|', $parent);

        if ($parent_explode[0] == 'User') {
            $vacancy->parent_type = 'App\Models\User';
            $vacancy->parent_id = $parent_explode[1];
        } elseif ($parent_explode[0] == 'Company') {
            $vacancy->parent_type = 'App\Models\Company';
            $vacancy->parent_id = $parent_explode[1];
        } elseif ($parent_explode[0] == 'Group') {
            $vacancy->parent_type = 'App\Models\Group';
            $vacancy->parent_id = $parent_explode[1];
        } else {
            $vacancy->parent_type = 'App\Models\Admin';
            $vacancy->parent_id = 1;
        }

        $vacancy->save();

        return redirect()->route('myvacancies.index')->with('success', 'Вакансия "' . $vacancy->name . '" добавлена');
    }

    public function show(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $vacancy = Vacancy::with('parent')->find($id);

        if (empty($vacancy)) {
            return redirect()->route('myvacancies.index')->with('alert', 'Вакансия не найдена');
        } else {
            if (
                ($vacancy->parent_type == 'App\Models\User'     && $vacancy->parent_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Company'  && $vacancy->parent->user_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Group'    && $vacancy->parent->user_id == Auth::user()->id)
            ) {
                return view('profile.pages.vacancy.show', [
                    'city'   => $request->session()->get('city'),
                    'vacancy' => $vacancy,
                    'cities' => $cities
                ]);
            } else {
                return redirect()->route('myvacancies.index')->with('alert', 'Вакансия не найдена');
            }
        }
    }

    public function edit(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $vacancy = Vacancy::with('parent')->find($id);

        if (empty($vacancy)) {
            return redirect()->route('myvacancy.index')->with('alert', 'Вакансия не найдена');
        } else {
            if (
                ($vacancy->parent_type == 'App\Models\User'     && $vacancy->parent_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Company'  && $vacancy->parent->user_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Group'    && $vacancy->parent->user_id == Auth::user()->id)
            ) {
                $groups = Group::where('user_id', '=', Auth::user()->id)->with('vacancies')->get();
                $companies = Company::where('user_id', '=', Auth::user()->id)->with('vacancies')->get();

                return view('profile.pages.vacancy.edit', [
                    'city'   => $request->session()->get('city'),
                    'vacancy' => $vacancy,
                    'cities' => $cities,
                    'groups'    => $groups,
                    'companies' => $companies,
                ]);
            } else {
                return redirect()->route('myvacancy.index')->with('alert', 'Вакансия не найдена');
            }
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
        ]);

        $city = City::with('region')->find($request->resume_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $vacancy = Vacancy::with('parent')->find($id);

        if (empty($vacancy)) {
            return redirect()->route('myvacancies.index')->with('alert', 'Вакансия не найдена');
        } else {
            if (
                ($vacancy->parent_type == 'App\Models\User'     && $vacancy->parent_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Company'  && $vacancy->parent->user_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Group'    && $vacancy->parent->user_id == Auth::user()->id)
            ) {
                $vacancy->name = $request->name;
                $vacancy->address = $request->address;
                $vacancy->description = $request->description;
                $vacancy->price = $request->price;

                $vacancy->city_id = $request->vacancy_city;
                $vacancy->region_id = $city->region->id;

                $parent = $request->parent;
                $parent_explode = explode('|', $parent);

                if ($parent_explode[0] == 'User') {
                    $vacancy->parent_type = 'App\Models\User';
                    $vacancy->parent_id = $parent_explode[1];
                } elseif ($parent_explode[0] == 'Company') {
                    $vacancy->parent_type = 'App\Models\Company';
                    $vacancy->parent_id = $parent_explode[1];
                } elseif ($parent_explode[0] == 'Group') {
                    $vacancy->parent_type = 'App\Models\Group';
                    $vacancy->parent_id = $parent_explode[1];
                } else {
                    $vacancy->parent_type = 'App\Models\Admin';
                    $vacancy->parent_id = 1;
                }

                $vacancy->save();

                return redirect()->route('myvacancies.index')->with('success', 'Резюме "' . $vacancy->name . '" обнавлено');
            } else {
                return redirect()->route('myvacancies.index')->with('alert', 'Вакансия не найдена');
            }
        }
    }

    public function destroy($id)
    {
        $vacancy = Vacancy::with('parent')->find($id);

        if (empty($vacancy)) {
            return redirect()->route('myvacancies.index')->with('alert', 'Вакансия не найдена');
        } else {
            if (
                ($vacancy->parent_type == 'App\Models\User'     && $vacancy->parent_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Company'  && $vacancy->parent->user_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Group'    && $vacancy->parent->user_id == Auth::user()->id)
            ) {
                $vacancy->delete();

                return redirect()->route('myvacancies.index')->with('success', 'Резюме удалено');
            } else {
                return redirect()->route('myvacancies.index')->with('alert', 'Вакансия не найдена');
            }
        }
    }
}
