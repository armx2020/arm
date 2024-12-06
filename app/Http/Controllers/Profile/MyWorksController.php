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

class MyWorksController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $entitiesName = 'myworks';
        $entityName = 'mywork';

        $works = Auth::user()->works()->paginate(10);

        return view('profile.pages.works.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId'),
            'entities' => $works,
            'entitiesName' => $entitiesName,
            'entityName' => $entityName,
        ]);
    }

    public function create(Request $request)
    {
        $companies = Company::where('user_id', '=', Auth::user()->id)->get();
        $groups = Group::where('user_id', '=', Auth::user()->id)->get();

        return view('profile.pages.works.create', [
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

        $city = City::with('region')->find($request->work_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $work = new Work();

        $work->name = $request->name;
        $work->address = $request->address;
        $work->description = $request->description;
        $work->city_id = $request->work_city;
        $work->region_id = $city->region->id;
        $work->type = $request->type;

        $parent = $request->parent;
        $parent_explode = explode('|', $parent);

        if ($parent_explode[0] == 'User') {
            $work->parent_type = 'App\Models\User';
            $work->parent_id = $parent_explode[1];
        } elseif ($parent_explode[0] == 'Company') {
            $work->parent_type = 'App\Models\Company';
            $work->parent_id = $parent_explode[1];
        } elseif ($parent_explode[0] == 'Group') {
            $work->parent_type = 'App\Models\Group';
            $work->parent_id = $parent_explode[1];
        } else {
            $work->parent_type = 'App\Models\User';
            $work->parent_id = 1;
        }

        if ($request->image) {
            $work->image = $request->file('image')->store('companies', 'public');
            Image::make('storage/' . $work->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $work->save();

        return redirect()->route('myworks.index')->with('success', 'Вакансия "' . $work->name . '" добавлена');
    }

    public function show(Request $request, $id)
    {
        $work = Work::with('parent')->find($id);

        if (empty($work)) {
            return redirect()->route('myworks.index')->with('alert', 'Вакансия не найдена');
        } else {
            if (
                ($work->parent_type == 'App\Models\User'     && $work->parent_id == Auth::user()->id) ||
                ($work->parent_type == 'App\Models\Company'  && $work->parent->user_id == Auth::user()->id) ||
                ($work->parent_type == 'App\Models\Group'    && $work->parent->user_id == Auth::user()->id)
            ) {
                return view('profile.pages.work.show', [
                    'region'   => $request->session()->get('region'),
                    'regions' => $this->regions,
                    'work' => $work,
                ]);
            } else {
                return redirect()->route('myworks.index')->with('alert', 'Вакансия не найдена');
            }
        }
    }

    public function edit(Request $request, $id)
    {
        $work = Work::with('parent')->find($id);

        if (empty($work)) {
            return redirect()->route('myworks.index')->with('alert', 'Вакансия не найдена');
        } else {
            if (
                ($work->parent_type == 'App\Models\User'     && $work->parent_id == Auth::user()->id) ||
                ($work->parent_type == 'App\Models\Company'  && $work->parent->user_id == Auth::user()->id) ||
                ($work->parent_type == 'App\Models\Group'    && $work->parent->user_id == Auth::user()->id)
            ) {
                $groups = Group::where('user_id', '=', Auth::user()->id)->with('works')->get();
                $companies = Company::where('user_id', '=', Auth::user()->id)->with('works')->get();

                return view('profile.pages.work.edit', [
                    'region'   => $request->session()->get('region'),
                    'regions' => $this->regions,
                    'work' => $work,
                    'groups'    => $groups,
                    'companies' => $companies,
                    'regionCode' => $request->session()->get('regionId')
                ]);
            } else {
                return redirect()->route('myworks.index')->with('alert', 'Вакансия не найдена');
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

        $work = Work::work()->with('parent')->find($id);

        if (empty($work)) {
            return redirect()->route('myworks.index')->with('alert', 'Вакансия не найдена');
        } else {
            if (
                ($work->parent_type == 'App\Models\User'     && $work->parent_id == Auth::user()->id) ||
                ($work->parent_type == 'App\Models\Company'  && $work->parent->user_id == Auth::user()->id) ||
                ($work->parent_type == 'App\Models\Group'    && $work->parent->user_id == Auth::user()->id)
            ) {
                $work->name = $request->name;
                $work->address = $request->address;
                $work->description = $request->description;

                $work->city_id = $request->work_city;
                $work->region_id = $city->region->id;

                $parent = $request->parent;
                $parent_explode = explode('|', $parent);

                if ($parent_explode[0] == 'User') {
                    $work->parent_type = 'App\Models\User';
                    $work->parent_id = $parent_explode[1];
                } elseif ($parent_explode[0] == 'Company') {
                    $work->parent_type = 'App\Models\Company';
                    $work->parent_id = $parent_explode[1];
                } elseif ($parent_explode[0] == 'Group') {
                    $work->parent_type = 'App\Models\Group';
                    $work->parent_id = $parent_explode[1];
                } else {
                    $work->parent_type = 'App\Models\User';
                    $work->parent_id = 1;
                }

                if ($request->image_remove == 'delete') {
                    Storage::delete('public/' . $work->image);
                    $work->image = null;
                }

                if ($request->image) {
                    Storage::delete('public/' . $work->image);
                    $work->image = $request->file('image')->store('companies', 'public');
                    Image::make('storage/' . $work->image)->resize(400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save();
                }

                $work->save();

                return redirect()->route('myworks.index')->with('success', 'Вакансия "' . $work->name . '" обнавлена');
            } else {
                return redirect()->route('myworks.index')->with('alert', 'Вакансия не найдена');
            }
        }
    }

    public function destroy($id)
    {
        $work = Work::work()->with('parent')->find($id);

        if (empty($work)) {
            return redirect()->route('myworks.index')->with('alert', 'Вакансия не найдена');
        } else {
            if (
                ($work->parent_type == 'App\Models\User'     && $work->parent_id == Auth::user()->id) ||
                ($work->parent_type == 'App\Models\Company'  && $work->parent->user_id == Auth::user()->id) ||
                ($work->parent_type == 'App\Models\Group'    && $work->parent->user_id == Auth::user()->id)
            ) {
                if ($work->image !== null) {
                    Storage::delete('public/' . $work->image);
                }

                $work->delete();

                return redirect()->route('myworks.index')->with('success', 'Вакансия удалена');
            } else {
                return redirect()->route('myworks.index')->with('alert', 'Вакансия не найдена');
            }
        }
    }
}
