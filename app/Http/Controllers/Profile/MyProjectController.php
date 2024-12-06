<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\BaseController;
use App\Models\City;
use App\Models\Company;
use App\Models\Group;
use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class MyProjectController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $entitiesName = 'myprojects';
        $entityName = 'myproject';

        $projects = Auth::user()->projects()->paginate(10);

        return view('profile.pages.project.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'entities' => $projects,
            'entitiesName' => $entitiesName,
            'entityName' => $entityName,
        ]);
    }

    public function create(Request $request)
    {
        $companies = Company::where('user_id', '=', Auth::user()->id)->get();
        $groups = Group::where('user_id', '=', Auth::user()->id)->get();

        return view('profile.pages.project.create', [
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
            'image' => ['image'],
        ]);

        $city = City::with('region')->find($request->project_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $project = new Project();

        $project->name = $request->name;
        $project->address = $request->address;
        $project->description = $request->description;

        $project->donations_need = $request->donations_need;

        $project->city_id = $request->project_city;
        $project->region_id = $city->region->id;

        $parent = $request->parent;
        $parent_explode = explode('|', $parent);

        if ($parent_explode[0] == 'User') {
            $project->parent_type = 'App\Models\User';
            $project->parent_id = $parent_explode[1];
        } elseif ($parent_explode[0] == 'Company') {
            $project->parent_type = 'App\Models\Company';
            $project->parent_id = $parent_explode[1];
        } elseif ($parent_explode[0] == 'Group') {
            $project->parent_type = 'App\Models\Group';
            $project->parent_id = $parent_explode[1];
        } else {
            $project->parent_type = 'App\Models\User';
            $project->parent_id = 1;
        }

        if ($request->image) {
            $project->image = $request->file('image')->store('projects', 'public');
            Image::make('storage/' . $project->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $project->save();

        return redirect()->route('myprojects.index')->with('success', 'Проект "' . $project->name . '" добавлена');
    }

    public function show(Request $request, $id)
    {
        $project = Project::with('parent')->find($id);

        if (empty($project)) {
            return redirect()->route('myprojects.index')->with('alert', 'Проект не найден');
        } else {
            if (
                ($project->parent_type == 'App\Models\User'     && $project->parent_id == Auth::user()->id) ||
                ($project->parent_type == 'App\Models\Company'  && $project->parent->user_id == Auth::user()->id) ||
                ($project->parent_type == 'App\Models\Group'    && $project->parent->user_id == Auth::user()->id)
            ) {
                if ($project->donations_have > 0 && $project->donations_need > 0) {
                    $fullness = (round(($project->donations_have * 100) / $project->donations_need));
                } else {
                    $fullness = 0;
                }

                return view('profile.pages.project.show', [
                    'region'   => $request->session()->get('region'),
                    'regions' => $this->regions,
                    'project' => $project,
                    'fullness' => $fullness,
                    'regionCode' => $request->session()->get('regionId')
                ]);
            } else {
                return redirect()->route('myprojects.index')->with('alert', 'Проект не найден');
            }
        }
    }

    public function edit(Request $request, $id)
    {
        $project = Project::with('parent')->find($id);

        if (empty($project)) {
            return redirect()->route('myprojects.index')->with('alert', 'Проект не найден');
        } else {
            if (
                ($project->parent_type == 'App\Models\User'     && $project->parent_id == Auth::user()->id) ||
                ($project->parent_type == 'App\Models\Company'  && $project->parent->user_id == Auth::user()->id) ||
                ($project->parent_type == 'App\Models\Group'    && $project->parent->user_id == Auth::user()->id)
            ) {
                $companies = Company::where('user_id', '=', Auth::user()->id)->get();
                $groups = Group::where('user_id', '=', Auth::user()->id)->get();

                return view('profile.pages.project.edit', [
                    'region'   => $request->session()->get('region'),
                    'regions' => $this->regions,
                    'project' => $project,
                    'companies' => $companies,
                    'groups'    => $groups,
                    'regionCode' => $request->session()->get('regionId')
                ]);
            } else {
                return redirect()->route('myprojects.index')->with('alert', 'Проект не найден');
            }
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['max:128'],
            'image' => ['image'],
        ]);

        $city = City::with('region')->find($request->project_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $project = Project::with('parent')->find($id);

        if (empty($project)) {
            return redirect()->route('myprojects.index')->with('alert', 'Проект не найден');
        } else {
            if (
                ($project->parent_type == 'App\Models\User'     && $project->parent_id == Auth::user()->id) ||
                ($project->parent_type == 'App\Models\Company'  && $project->parent->user_id == Auth::user()->id) ||
                ($project->parent_type == 'App\Models\Group'    && $project->parent->user_id == Auth::user()->id)
            ) {
                $project->name = $request->name;
                $project->address = $request->address;
                $project->description = $request->description;

                $project->donations_need = $request->donations_need;
                $project->donations_have = $request->donations_have;

                $parent = $request->parent;
                $parent_explode = explode('|', $parent);

                if ($parent_explode[0] == 'User') {
                    $project->parent_type = 'App\Models\User';
                    $project->parent_id = $parent_explode[1];
                } elseif ($parent_explode[0] == 'Company') {
                    $project->parent_type = 'App\Models\Company';
                    $project->parent_id = $parent_explode[1];
                } elseif ($parent_explode[0] == 'Group') {
                    $project->parent_type = 'App\Models\Group';
                    $project->parent_id = $parent_explode[1];
                } else {
                    $project->parent_type = 'App\Models\User';
                    $project->parent_id = 1;
                }

                if ($request->image_remove == 'delete') {
                    Storage::delete('public/' . $project->image);
                    $project->image = null;
                }

                if ($request->image) {
                    Storage::delete('public/' . $project->image);
                    $project->image = $request->file('image')->store('projects', 'public');
                    Image::make('storage/' . $project->image)->resize(400, null, function ($constraint) {
                        $constraint->aspectRatio();
                    })->save();
                }
                $project->update();

                return redirect()->route('myprojects.show', ['myproject' => $project->id])->with('success', 'Проект "' . $project->name . '" обнавлен');
            } else {
                return redirect()->route('myprojects.index')->with('alert', 'Проект не найден');
            }
        }
    }

    public function destroy($id)
    {
        $project = Project::with('parent')->find($id);

        if (empty($project)) {
            return redirect()->route('myprojects.index')->with('alert', 'Проект не найден');
        } else {
            if (
                ($project->parent_type == 'App\Models\User'     && $project->parent_id == Auth::user()->id) ||
                ($project->parent_type == 'App\Models\Company'  && $project->parent->user_id == Auth::user()->id) ||
                ($project->parent_type == 'App\Models\Group'    && $project->parent->user_id == Auth::user()->id)
            ) {
                if ($project->image !== null) {
                    Storage::delete('public/' . $project->image);
                }

                $project->delete();

                return redirect()->route('myprojects.index')->with('success', 'Проект удален');
            } else {
                return redirect()->route('myprojects.index')->with('alert', 'Проект не найден');
            }
        }
    }
}
