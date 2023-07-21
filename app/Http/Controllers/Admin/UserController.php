<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.user.index');
    }

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    { 
        $request->validate([
            'firstname' => ['required', 'string', 'max:32'],
            'lastname' => ['required', 'string', 'max:32'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'viber' => ['max:36'],
            'whatsapp' => ['max:36'],
            'telegram' => ['max:36'],
            'instagram' => ['max:36'],
            'vkontakte' => ['max:36'],
        ]);

        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $user = new User();

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->city_id = $request->city;
        $user->region_id = $city->region->id;
        $user->viber = $request->viber;
        $user->whatsapp = $request->whatsapp;
        $user->telegram = $request->telegram;
        $user->instagram = $request->instagram;
        $user->vkontakte = $request->vkontakte;

        if ($request->image) {
            $user->image = $request->file('image')->store('users', 'public');
        }
        
        $user->save();

        return redirect()->route('admin.user.index')->with('success', 'The user added');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::with(
            'events',
            'groups',
            'companies',
            'resumes',
            'projects',
            'vacancies'
        )
            ->findOrFail($id);

        if(empty($user)) {
            return redirect()->route('admin.user.index')->with('alert', 'The user no finded');
        }

        return view('admin.user.show', ['user' => $user]);
    }

    public function edit(string $id)
    {
        $user = User::find($id);

        if(empty($user)) {
            return redirect()->route('admin.user.index')->with('alert', 'The user no finded');
        }

        return view('admin.user.edit', ['user' => $user]);
    }

    public function update(Request $request, string $id)
    { 
        $request->validate([
            'firstname' => ['required', 'string', 'max:32'],
            'lastname' => ['required', 'string', 'max:32'],
            'viber' => ['max:36'],
            'whatsapp' => ['max:36'],
            'telegram' => ['max:36'],
            'instagram' => ['max:36'],
            'vkontakte' => ['max:36'],
        ]);
    
        $user = User::find($id);

        if(empty($user)) {
            return redirect()->route('admin.user.index')->with('alert', 'The user no finded');
        }

        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        if ($request->image) {
            Storage::delete('public/'.$user->image);
            $user->image = $request->file('image')->store('users', 'public');
        }

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->city_id = $request->city;
        $user->region_id = $city->region->id;
        $user->viber = $request->viber;
        $user->whatsapp = $request->whatsapp;
        $user->telegram = $request->telegram;
        $user->instagram = $request->instagram;
        $user->vkontakte = $request->vkontakte;

        $user->update();

        return redirect()->route('admin.user.show', ['user' => $user->id])
            ->with('success', "The user saved");
    }

    public function destroy(string $id)
    {
        $user = User::with('inGroups')->find($id);

        if(empty($user)) {
            return redirect()->route('admin.user.index')->with('alert', 'The user no finded');
        }

        foreach($user->inGroups as $group) {
            $user->inGroups()->detach($group->id);
        }

        if($user->image !== null) {
            Storage::delete('public/'.$user->image);
        }

        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'The user deleted');
    }
}
