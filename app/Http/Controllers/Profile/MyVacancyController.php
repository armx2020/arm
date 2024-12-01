<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\BaseController;
use App\Models\City;
use App\Models\Company;
use App\Models\Group;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class MyVacancyController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $vacancies = Auth::user()->works->where('type', 'vacancy');
        $groups = Group::where('user_id', '=', Auth::user()->id)->with('works')->get();
        $companies = Company::where('user_id', '=', Auth::user()->id)->with('works')->get();

        return view('profile.pages.vacancy.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'vacancies' => $vacancies,
            'groups'    => $groups,
            'companies' => $companies,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function create(Request $request)
    {
        $companies = Company::where('user_id', '=', Auth::user()->id)->get();
        $groups = Group::where('user_id', '=', Auth::user()->id)->get();

        return view('profile.pages.vacancy.create', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'companies' => $companies,
            'groups'    => $groups,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['max:128'],
        ]);

        $city = City::with('region')->find($request->vacancy_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $vacancy = new Work();

        $vacancy->name = $request->name;
        $vacancy->address = $request->address;
        $vacancy->description = $request->description;
        $vacancy->city_id = $request->vacancy_city;
        $vacancy->region_id = $city->region->id;
        $vacancy->type = 'vacancy';

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
            $vacancy->parent_type = 'App\Models\User';
            $vacancy->parent_id = 1;
        }

        if ($request->image) {
            $vacancy->image = $request->file('image')->store('companies', 'public');
            Image::make('storage/' . $vacancy->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $vacancy->save();

        return redirect()->route('myvacancies.index')->with('success', 'Вакансия "' . $vacancy->name . '" добавлена');
    }

    public function show(Request $request, $id)
    {
        $vacancy = Work::vacancy()->with('parent')->find($id);

        if (empty($vacancy)) {
            return redirect()->route('myvacancies.index')->with('alert', 'Вакансия не найдена');
        } else {
            if (
                ($vacancy->parent_type == 'App\Models\User'     && $vacancy->parent_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Company'  && $vacancy->parent->user_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Group'    && $vacancy->parent->user_id == Auth::user()->id)
            ) {
                return view('profile.pages.vacancy.show', [
                    'region'   => $request->session()->get('region'),
                    'regions' => $this->regions,
                    'vacancy' => $vacancy,
                ]);
            } else {
                return redirect()->route('myvacancies.index')->with('alert', 'Вакансия не найдена');
            }
        }
    }

    public function edit(Request $request, $id)
    {
        $vacancy = Work::vacancy()->with('parent')->find($id);

        if (empty($vacancy)) {
            return redirect()->route('myvacancy.index')->with('alert', 'Вакансия не найдена');
        } else {
            if (
                ($vacancy->parent_type == 'App\Models\User'     && $vacancy->parent_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Company'  && $vacancy->parent->user_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Group'    && $vacancy->parent->user_id == Auth::user()->id)
            ) {
                $groups = Group::where('user_id', '=', Auth::user()->id)->with('works')->get();
                $companies = Company::where('user_id', '=', Auth::user()->id)->with('works')->get();

                return view('profile.pages.vacancy.edit', [
                    'region'   => $request->session()->get('region'),
                    'regions' => $this->regions,
                    'vacancy' => $vacancy,
                    'groups'    => $groups,
                    'companies' => $companies,
                    'regionCode' => $request->session()->get('regionId')
                ]);
            } else {
                return redirect()->route('myvacancy.index')->with('alert', 'Вакансия не найдена');
            }
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['max:128'],
        ]);

        $city = City::with('region')->find($request->resume_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $vacancy = Work::vacancy()->with('parent')->find($id);

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
                    $vacancy->parent_type = 'App\Models\User';
                    $vacancy->parent_id = 1;
                }

                if ($request->image_remove == 'delete') {
                    Storage::delete('public/' . $vacancy->image);
                    $vacancy->image = null;
                }
        
                if ($request->image) {
                    Storage::delete('public/' . $vacancy->image);
                    $vacancy->image = $request->file('image')->store('companies', 'public');
                    Image::make('storage/' . $vacancy->image)->resize(400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save();
                }

                $vacancy->save();

                return redirect()->route('myvacancies.index')->with('success', 'Вакансия "' . $vacancy->name . '" обнавлена');
            } else {
                return redirect()->route('myvacancies.index')->with('alert', 'Вакансия не найдена');
            }
        }
    }

    public function destroy($id)
    {
        $vacancy = Work::vacancy()->with('parent')->find($id);

        if (empty($vacancy)) {
            return redirect()->route('myvacancies.index')->with('alert', 'Вакансия не найдена');
        } else {
            if (
                ($vacancy->parent_type == 'App\Models\User'     && $vacancy->parent_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Company'  && $vacancy->parent->user_id == Auth::user()->id) ||
                ($vacancy->parent_type == 'App\Models\Group'    && $vacancy->parent->user_id == Auth::user()->id)
            ) {
                if ($vacancy->image !== null) {
                    Storage::delete('public/' . $vacancy->image);
                }

                $vacancy->delete();

                return redirect()->route('myvacancies.index')->with('success', 'Вакансия удалена');
            } else {
                return redirect()->route('myvacancies.index')->with('alert', 'Вакансия не найдена');
            }
        }
    }
}
