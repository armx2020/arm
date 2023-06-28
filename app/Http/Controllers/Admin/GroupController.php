<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Group;
use App\Models\GroupCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class GroupController extends Controller
{
    public function index()
    {
       return view('admin.group.index');
    }

    public function create()
    {
        $categories = GroupCategory::all();
        $users = User::all();

        return view('admin.group.create', ['categories' => $categories, 'users' => $users]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:128'],
            'phone' => ['max:36'],
            'web' => ['max:250'],
            'viber' => ['max:36'],
            'whatsapp' => ['max:36'],
            'telegram' => ['max:36'],
            'instagram' => ['max:36'],
            'vkontakte' => ['max:36'],
            'image' => ['image', 'max:2048'],
            'image1' => ['image', 'max:2048'],
            'image2' => ['image', 'max:2048'],
            'image3' => ['image', 'max:2048'],
            'image4' => ['image', 'max:2048'],
        ]);

        $city = City::with('region')->findOrFail($request->city);

        $group = new Group();

        $group->name = $request->name;
        $group->address = $request->address;
        $group->description = $request->description;
        $group->city_id = $request->city;
        $group->region_id = $city->region->id; // add to region key
        $group->phone = $request->phone;
        $group->web = $request->web;
        $group->viber = $request->viber;
        $group->whatsapp = $request->whatsapp;
        $group->telegram = $request->telegram;
        $group->instagram = $request->instagram;
        $group->vkontakte = $request->vkontakte;
        $group->user_id = $request->user;
        $group->group_category_id = $request->category;

        if ($request->image) {
            $group->image = $request->file('image')->store('groups', 'public');
        }
        if ($request->image1) {
            $group->image1 = $request->file('image1')->store('groups', 'public');
        }
        if ($request->image2) {
            $group->image2 = $request->file('image2')->store('groups', 'public');
        }
        if ($request->image3) {
            $group->image3 = $request->file('image3')->store('groups', 'public');
        }
        if ($request->image4) {
            $group->image4 = $request->file('image4')->store('groups', 'public');
        }

        $group->save();

        return redirect()->route('admin.group.index')->with('success', 'The group added');
    }

    public function show(string $id)
    {
        $group = Group::with('user', 'category', 'users')->findOrFail($id);
        return view('admin.group.show', ['group' => $group]);
    }

    public function edit(string $id)
    {
        $group = Group::with('user', 'category')->findOrFail($id);
        $categories = GroupCategory::all();
        $users = User::all();
        $user = $group->user;
        $category = $group->category;

        return view('admin.group.edit', [   'group' => $group,
                                            'user' => $user,
                                            'category' => $category,
                                            'categories' => $categories,
                                            'users' => $users]);
    }

    public function update(Request $request, string $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['required', 'string', 'max:128'],
            'phone' => ['max:36'],
            'web' => ['max:250'],
            'viber' => ['max:36'],
            'whatsapp' => ['max:36'],
            'telegram' => ['max:36'],
            'instagram' => ['max:36'],
            'vkontakte' => ['max:36'],
            'image' => ['image', 'max:2048'],
            'image1' => ['image', 'max:2048'],
            'image2' => ['image', 'max:2048'],
            'image3' => ['image', 'max:2048'],
            'image4' => ['image', 'max:2048'],
        ]);

        $city = City::with('region')->findOrFail($request->city);


        $group = Group::findOrFail($id);

        $group->name = $request->name;
        $group->address = $request->address;
        $group->description = $request->description;
        $group->city_id = $request->city;
        $group->region_id = $city->region->id; // add to region key
        $group->phone = $request->phone;
        $group->web = $request->web;
        $group->viber = $request->viber;
        $group->whatsapp = $request->whatsapp;
        $group->telegram = $request->telegram;
        $group->instagram = $request->instagram;
        $group->vkontakte = $request->vkontakte;
        $group->user_id = $request->user;
        $group->group_category_id = $request->category;

        if ($request->image) {
            Storage::delete('public/'.$group->image);
            $group->image = $request->file('image')->store('groups', 'public');
        }
        if ($request->image1) {
            Storage::delete('public/'.$group->image1);
            $group->image1 = $request->file('image1')->store('groups', 'public');
        }
        if ($request->image2) {
            Storage::delete('public/'.$group->image2);
            $group->image2 = $request->file('image2')->store('groups', 'public');
        }
        if ($request->image3) {
            Storage::delete('public/'.$group->image3);
            $group->image3 = $request->file('image3')->store('groups', 'public');
        }
        if ($request->image4) {
            Storage::delete('public/'.$group->image4);
            $group->image4 = $request->file('image4')->store('groups', 'public');
        }

        $group->update();

        return redirect()->route('admin.group.show', ['group'=>$group->id])
                        ->with('success', 'The group saved');
    }

    public function destroy(string $id)
    {
        $group = Group::with('users')->findOrFail($id);

        foreach($group->users as $user) {
            $group->users()->detach($user->id);
        }

        if($group->image !== null) {
            Storage::delete('public/'.$group->image);
        }
        if($group->image1 !== null) {
            Storage::delete('public/'.$group->image1);
        }
        if($group->image2 !== null) {
            Storage::delete('public/'.$group->image2);
        }
        if($group->image3 !== null) {
            Storage::delete('public/'.$group->image3);
        }
        if($group->image4 !== null) {
            Storage::delete('public/'.$group->image4);
        }

        $group->delete();

        return redirect()->route('admin.group.index')->with('success', 'The group deleted');
    }
}
