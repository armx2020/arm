<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\BaseController;
use App\Models\City;
use App\Models\Work;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class MyResumeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $resumes = Auth::user()->works->where('type', 'resume');

        return view('profile.pages.resume.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'resumes' => $resumes,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function create(Request $request)
    {
        return view('profile.pages.resume.create', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'address' => ['max:128'],
        ]);

        $city = City::with('region')->find($request->resume_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $resume = new Work();

        $resume->name = $request->name;
        $resume->address = $request->address;
        $resume->description = $request->description;
        $resume->city_id = $request->resume_city;
        $resume->region_id = $city->region->id;
        $resume->type = 'resume';
        $resume->parent_type = 'App\Models\User';
        $resume->parent_id = Auth::user()->id;

        if ($request->image) {
            $resume->image = $request->file('image')->store('companies', 'public');
            Image::make('storage/' . $resume->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }


        $resume->save();

        return redirect()->route('myresumes.index')->with('success', 'Резюме "' . $resume->name . '" добавлено');
    }

    public function show(Request $request, $id)
    {
        $resume = Work::resume()->with('parent')->where('parent_id', '=', Auth::user()->id)->find($id);

        if (empty($resume)) {
            return redirect()->route('myresumes.index')->with('alert', 'Резюме не найдено');
        } else {
            return view('profile.pages.resume.show', [
                'region'   => $request->session()->get('region'),
                'regions' => $this->regions,
                'resume' => $resume,
                'regionCode' => $request->session()->get('regionId')
            ]);
        }
    }

    public function edit(Request $request, $id)
    {
        $resume = Work::resume()->with('parent')->where('parent_id', '=', Auth::user()->id)->find($id);

        if (empty($resume)) {
            return redirect()->route('myresumes.index')->with('alert', 'Резюме не найдено');
        } else {
            return view('profile.pages.resume.edit', [
                'region'   => $request->session()->get('region'),
                'regions' => $this->regions,
                'resume' => $resume,
                'regionCode' => $request->session()->get('regionId')
            ]);
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

        $resume = Work::resume()->with('parent')->where('parent_id', '=', Auth::user()->id)->find($id);

        if (empty($resume)) {
            return redirect()->route('myresumes.index')->with('alert', 'Резюме не найдено');
        } else {
            $resume->name = $request->name;
            $resume->address = $request->address;
            $resume->description = $request->description;
            $resume->city_id = $request->resume_city;
            $resume->region_id = $city->region->id;

            if ($request->image_remove == 'delete') {
                Storage::delete('public/' . $resume->image);
                $resume->image = null;
            }
    
            if ($request->image) {
                Storage::delete('public/' . $resume->image);
                $resume->image = $request->file('image')->store('companies', 'public');
                Image::make('storage/' . $resume->image)->resize(400, null, function ($constraint) {
                    $constraint->aspectRatio();
                })->save();
            }

            $resume->save();

            return redirect()->route('myresumes.index')->with('success', 'Резюме "' . $resume->name . '" обнавлено');
        }
    }

    public function destroy($id)
    {
        $resume = Work::resume()->with('parent')->where('parent_id', '=', Auth::user()->id)->find($id);

        if (empty($resume)) {
            return redirect()->route('myresumes.index')->with('alert', 'Резюме не найдено');
        } else {
            if ($resume->image !== null) {
                Storage::delete('public/' . $resume->image);
            }

            $resume->delete();

            return redirect()->route('myresumes.index')->with('success', 'Резюме удалено');
        }
    }
}
