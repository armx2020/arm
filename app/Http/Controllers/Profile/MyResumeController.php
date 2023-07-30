<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Resume;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MyResumeController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $resumes = Auth::user()->resumes;

        return view('profile.pages.resume.index', [
            'city'   => $request->session()->get('city'),
            'resumes' => $resumes,
            'cities' => $cities
        ]);
    }

    public function store(Request $request)
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

        return redirect()->route('myresume.index')->with('success', 'Резюме "' . $resume->name . '" добавлено');
    }

    public function show(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $resume = Resume::with('user')->where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($resume)) {
            return redirect()->route('myresume.index')->with('alert', 'Резюме не найдено');
        }

        return view('profile.pages.resume.show', [
            'city'   => $request->session()->get('city'),
            'resume' => $resume,
            'cities' => $cities
        ]);
    }

    public function edit(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $resume = Resume::with('user')->where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($resume)) {
            return redirect()->route('myresume.index')->with('alert', 'Резюме не найдено');
        }

        return view('profile.pages.resume.edit', [
            'city'   => $request->session()->get('city'),
            'resume' => $resume,
            'cities' => $cities
        ]);
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

        $resume = Resume::with('user')->where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($resume)) {
            return redirect()->route('myresume.index')->with('alert', 'Резюме не найдено');
        }

        $resume->name = $request->name;
        $resume->address = $request->address;
        $resume->description = $request->description;
        $resume->price = $request->price;

        $resume->city_id = $request->resume_city;
        $resume->region_id = $city->region->id;

        $resume->user_id = Auth::user()->id;

        $resume->update();

        return redirect()->route('myresume.show', ['id' => $resume->id])->with('success', 'Резюме "' . $resume->name . '" обнавлено');
    }

    public function destroy($id)
    {
        $resume = Resume::where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($resume)) {
            return redirect()->route('myresume.index')->with('alert', 'Резюме не найдено');
        }

        $resume->delete();

        return redirect()->route('myresume.index')->with('success', 'Резюме удалено');
    }
}
