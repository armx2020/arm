<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
use App\Models\Group;
use App\Models\Resume;
use App\Models\Vacancy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyWorkController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $resumes = Auth::user()->resumes;
        $vacancies = Auth::user()->vacancies;
        $groups = Group::where('user_id', '=', Auth::user()->id)->with('vacancies')->get();
        $companies = Company::where('user_id', '=', Auth::user()->id)->with('vacancies')->get();

        return view('profile.pages.work.index', [
            'city'      => $request->session()->get('city'),
            'resumes'   => $resumes,
            'vacancies' => $vacancies,
            'groups'    => $groups,
            'companies' => $companies,
            'cities'    => $cities
        ]);
    }

    public function store_resume(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
        ]);

        $city = City::with('region')->find($request->resume_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $resume = new Resume();

        $resume->name = $request->name;
        $resume->address = $request->address;
        $resume->description = $request->description;
        $resume->price = $request->price;

        $resume->city_id = $request->resume_city;
        $resume->region_id = $city->region->id;

        $resume->user_id = Auth::user()->id;

        $resume->save();

        return redirect()->route('myworks.index')->with('success', 'Резюме "' . $resume->name . '" добавлено');
    }

    public function store_vacancy(Request $request)
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

        return redirect()->route('myworks.index')->with('success', 'Вакансия "' . $vacancy->name . '" добавлена');
    }

    public function show_resume(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $resume = Resume::with('user')->where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($resume)) {
            return redirect()->route('myworks.index')->with('alert', 'Резюме не найдено');
        } else {
            return view('profile.pages.work.show_resume', [
                'city'   => $request->session()->get('city'),
                'resume' => $resume,
                'cities' => $cities
            ]);
        }
    }

    public function show_vacancy(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $vacancy = Vacancy::with('parent')->find($id);

        if (empty($vacancy)) {
            return redirect()->route('myworks.index')->with('alert', 'Вакансия не найдена');
        } else {
            if (
                ($vacancy->parent_type == 'App\Models\User'     && $vacancy->parent_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Company'  && $vacancy->parent->user_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Group'    && $vacancy->parent->user_id == Auth::user()->id)
            ) {
                return view('profile.pages.work.show_vacancy', [
                    'city'   => $request->session()->get('city'),
                    'vacancy' => $vacancy,
                    'cities' => $cities
                ]);
            } else {
                return redirect()->route('myworks.index')->with('alert', 'Вакансия не найдена');
            }
        }
    }

    public function edit_resume(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $resume = Resume::with('user')->where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($resume)) {
            return redirect()->route('myworks.index')->with('alert', 'Резюме не найдено');
        } else {
            return view('profile.pages.work.edit_resume', [
                'city'   => $request->session()->get('city'),
                'resume' => $resume,
                'cities' => $cities
            ]);
        }
    }

    public function edit_vacancy(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $vacancy = Vacancy::with('parent')->find($id);

        if (empty($vacancy)) {
            return redirect()->route('myworks.index')->with('alert', 'Вакансия не найдена');
        } else {
            if (
                ($vacancy->parent_type == 'App\Models\User'     && $vacancy->parent_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Company'  && $vacancy->parent->user_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Group'    && $vacancy->parent->user_id == Auth::user()->id)
            ) {
                return view('profile.pages.work.edit_vacancy', [
                    'city'   => $request->session()->get('city'),
                    'vacancy' => $vacancy,
                    'cities' => $cities
                ]);
            } else {
                return redirect()->route('myworks.index')->with('alert', 'Вакансия не найдена');
            }
        }
    }

    public function update_resume(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
        ]);

        $city = City::with('region')->find($request->resume_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $resume = Resume::with('user')->where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($resume)) {
            return redirect()->route('myworks.index')->with('alert', 'Резюме не найдено');
        } else {
            $resume->name = $request->name;
            $resume->address = $request->address;
            $resume->description = $request->description;
            $resume->price = $request->price;

            $resume->city_id = $request->resume_city;
            $resume->region_id = $city->region->id;

            $resume->save();

            return redirect()->route('myworks.index')->with('success', 'Резюме "' . $resume->name . '" обнавлено');
        }
    }

    public function update_vacancy(Request $request, $id)
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
            return redirect()->route('myworks.index')->with('alert', 'Вакансия не найдена');
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

                $vacancy->save();

                return redirect()->route('myworks.index')->with('success', 'Резюме "' . $vacancy->name . '" обнавлено');
            } else {
                return redirect()->route('myworks.index')->with('alert', 'Вакансия не найдена');
            }
        }
    }

    public function destroy_resume($id)
    {
        $resume = Resume::with('user')->where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($resume)) {
            return redirect()->route('myworks.index')->with('alert', 'Резюме не найдено');
        } else {

            $resume->delete();

            return redirect()->route('myworks.index')->with('success', 'Резюме удалено');
        }        
    }

    public function destroy_vacancy($id)
    {
        $vacancy = Vacancy::with('parent')->find($id);

        if (empty($vacancy)) {
            return redirect()->route('myworks.index')->with('alert', 'Вакансия не найдена');
        } else {
            if (
                ($vacancy->parent_type == 'App\Models\User'     && $vacancy->parent_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Company'  && $vacancy->parent->user_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Group'    && $vacancy->parent->user_id == Auth::user()->id)
            ) {
                $vacancy->delete();

                return redirect()->route('myworks.index')->with('success', 'Резюме удалено');
            } else {
                return redirect()->route('myworks.index')->with('alert', 'Вакансия не найдена');
            }
        }           
    }
}
