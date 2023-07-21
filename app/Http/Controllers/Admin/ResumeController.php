<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Resume;
use App\Models\User;
use Illuminate\Http\Request;

class ResumeController extends Controller
{
    public function index()
    {
        return view('admin.resume.index');
    }

    public function create()
    {
        $users = User::all();
        return view('admin.resume.create', ['users' => $users]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
        ]);

        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $resume = new Resume();

        $resume->name = $request->name;
        $resume->address = $request->address;
        $resume->description = $request->description;
        $resume->city_id = $request->city;
        $resume->region_id = $city->region->id; // add to region key
        $resume->price = $request->price;
        $resume->user_id = $request->user;

        $resume->save();

        return redirect()->route('admin.resume.index')->with('success', 'The resume added');
    }

    public function show(string $id)
    {
        $resume = Resume::with('user')->find($id);

        if(empty($resume)) {
            return redirect()->route('admin.resume.index')->with('alert', 'The resume no finded');
        }

        return view('admin.resume.show', ['resume' => $resume]);
    }

    public function edit(string $id)
    {
        $resume = Resume::find($id);

        if(empty($resume)) {
            return redirect()->route('admin.resume.index')->with('alert', 'The resume no finded');
        }
        $users = User::all();
        
        return view('admin.resume.edit', ['resume'=>$resume, 'users'=>$users]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
        ]);

        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $resume = Resume::find($id);

        if(empty($resume)) {
            return redirect()->route('admin.resume.index')->with('alert', 'The resume no finded');
        }

        $resume->name = $request->name;
        $resume->address = $request->address;
        $resume->description = $request->description;
        $resume->city_id = $request->city;
        $resume->region_id = $city->region->id; // add to region key
        $resume->price = $request->price;
        $resume->user_id = $request->user;

        $resume->update();

        return redirect()->route('admin.resume.index')->with('success', 'The resume saved');
    }

    public function destroy(string $id)
    {
        $resume = Resume::find($id);

        if(empty($resume)) {
            return redirect()->route('admin.resume.index')->with('alert', 'The resume no finded');
        }
        
        $resume->delete();

        return redirect()->route('admin.resume.index')->with('success', 'The resume deleted');
    }
}
