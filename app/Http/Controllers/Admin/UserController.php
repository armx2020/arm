<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::with('city')->latest()->paginate(20);

        return view('admin.user.index', ['users' => $users]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.user.create');
    }

    /**
     * Store a newly created resource in storage.
     */
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
            'image' => ['image', 'max:2048'],
        ]);

        $user = new User();

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->viber = $request->viber;
        $user->whatsapp = $request->whatsapp;
        $user->telegram = $request->telegram;
        $user->instagram = $request->instagram;
        $user->vkontakte = $request->vkontakte;
        $user->image = $request->file('image')->store('users', 'public');

        

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

        return view('admin.user.show', ['user' => $user]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $user = User::find($id);

        return view('admin.user.edit', ['user' => $user]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    { 
        $request->validate([
            'firstname' => ['required', 'string', 'max:32'],
            'lastname' => ['required', 'string', 'max:32'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'viber' => ['max:36'],
            'whatsapp' => ['max:36'],
            'telegram' => ['max:36'],
            'instagram' => ['max:36'],
            'vkontakte' => ['max:36'],
            'image' => ['image', 'max:2048'],
        ]);
    
        $user = User::findOrFail($id);

        if ($request->image) {
            Storage::delete('public/'.$user->image);
            $user->image = $request->file('image')->store('users', 'public');
        }

        $user->firstname = $request->firstname;
        $user->lastname = $request->lastname;
        $user->phone = $request->phone;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->viber = $request->viber;
        $user->whatsapp = $request->whatsapp;
        $user->telegram = $request->telegram;
        $user->instagram = $request->instagram;
        $user->vkontakte = $request->vkontakte;

        $user->update();

        return redirect()->route('admin.user.show', ['user' => $user->id])
            ->with('success', "The user saved");
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::with(             // удалить связи
            'events',
            'groups',
            'companies',
            'resumes',
            'projects',
            'vacancies'
        )
            ->findOrFail($id);

        if($user->image !== null) {
            Storage::delete('public/'.$user->image);
        }

        $user->delete();

        return redirect()->route('admin.user.index')->with('success', 'The user deleted');
    }
}
