<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Group;
use App\Models\GroupCategory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyGroupController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $groups = Auth::user()->groups;
        $categories = GroupCategory::orderBy('sort_id', 'asc')->get();

        return view('profile.pages.group.index', [
            'city'   => $request->session()->get('city'),
            'groups' => $groups,
            'categories' => $categories,
            'cities' => $cities
        ]);
    }

    public function create(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $categories = GroupCategory::orderBy('sort_id', 'asc')->get();

        return view('profile.pages.group.create', [
            'city'   => $request->session()->get('city'),
            'categories' => $categories,
            'cities' => $cities
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
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

        $city = City::with('region')->find($request->group_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $group = new Group();

        $group->name = $request->name;
        $group->address = $request->address;
        $group->description = $request->description;
        $group->city_id = $request->group_city;
        $group->region_id = $city->region->id;
        $group->phone = $request->phone;
        $group->web = $request->web;
        $group->viber = $request->viber;
        $group->whatsapp = $request->whatsapp;
        $group->telegram = $request->telegram;
        $group->instagram = $request->instagram;
        $group->vkontakte = $request->vkontakte;
        $group->user_id = Auth::user()->id;
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

        return redirect()->route('mygroups.index')->with('success', 'Группа "' . $group->name . '" добавлена');
    }

    public function show(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $group = Group::where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($group)) {
            return redirect()->route('mygroups.index')->with('alert', 'Группа не найдена');
        }

        $sum =  ($group->address ? 10 : 0) +
            ($group->name ? 5 : 0) +
            ($group->description ? 10 : 0) +
            ($group->image ? 10 : 0) +
            ($group->phone ? 5 : 0) +
            ($group->web ? 5 : 0) +
            ($group->viber ? 5 : 0) +
            ($group->whatsapp ? 5 : 0) +
            ($group->instagram ? 5 : 0) +
            ($group->vkontakte ? 5 : 0) +
            ($group->telegram ? 5 : 0);

        $fullness = (round(($sum / 70) * 100));


        return view('profile.pages.group.show', [
            'city'   => $request->session()->get('city'),
            'group' => $group,
            'fullness' => $fullness,
            'cities' => $cities
        ]);
    }

    public function edit(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $group = Group::where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($group)) {
            return redirect()->route('mygroups.index')->with('alert', 'Группа не найдена');
        }

        $categories = GroupCategory::orderBy('sort_id', 'asc')->get();

        return view('profile.pages.group.edit', [
            'city'   => $request->session()->get('city'),
            'group' => $group,
            'categories' => $categories,
            'cities' => $cities
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
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

        $city = City::with('region')->find($request->group_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $group = Group::where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($group)) {
            return redirect()->route('mygroups.index')->with('alert', 'Группа не найдена');
        }

        $group->name = $request->name;
        $group->address = $request->address;
        $group->description = $request->description;
        $group->city_id = $request->group_city;
        $group->region_id = $city->region->id;
        $group->phone = $request->phone;
        $group->web = $request->web;
        $group->viber = $request->viber;
        $group->whatsapp = $request->whatsapp;
        $group->telegram = $request->telegram;
        $group->instagram = $request->instagram;
        $group->vkontakte = $request->vkontakte;
        $group->user_id = Auth::user()->id;
        $group->group_category_id = $request->category;


        if ($request->image_r == 'delete') {
            Storage::delete('public/' . $group->image);
            $group->image = null;            
        }

        if ($request->image_r1 == 'delete') {
            Storage::delete('public/' . $group->image1);
            $group->image1 = null;            
        }

        if ($request->image_r2 == 'delete') {
            Storage::delete('public/' . $group->image2);
            $group->image2 = null;            
        }

        if ($request->image_r3 == 'delete') {
            Storage::delete('public/' . $group->image3);
            $group->image3 = null;            
        }

        if ($request->image_r4 == 'delete') {
            Storage::delete('public/' . $group->image4);
            $group->image4 = null;            
        }


        if ($request->image) {
            Storage::delete('public/' . $group->image);            
            $group->image = $request->file('image')->store('groups', 'public');
        }

        if ($request->image1) {
            Storage::delete('public/' . $group->image1);
            $group->image1 = $request->file('image1')->store('groups', 'public');
        }

        if ($request->image2) {
            Storage::delete('public/' . $group->image2);
            $group->image2 = $request->file('image2')->store('groups', 'public');
        }

        if ($request->image3) {
            Storage::delete('public/' . $group->image3);
            $group->image3 = $request->file('image3')->store('groups', 'public');
        }

        if ($request->image4) {
            Storage::delete('public/' . $group->image4);
            $group->image4 = $request->file('image4')->store('groups', 'public');
        }

        $group->update();

        return redirect()->route('mygroups.show', ['mygroup' => $group->id])->with('success', 'Группа "' . $group->name . '" обнавлена');
    }

    public function destroy($id)
    {
        $group = Group::with('users')->where('user_id', '=', Auth::user()->id)->find($id);

        if (empty($group)) {
            return redirect()->route('mygroups.index')->with('alert', 'Группа не найдена');
        }

        foreach ($group->users as $user) {
            $group->users()->detach($user->id);
        }

        if ($group->image !== null) {
            Storage::delete('public/' . $group->image);
        }
        if ($group->image1 !== null) {
            Storage::delete('public/' . $group->image1);
        }
        if ($group->image2 !== null) {
            Storage::delete('public/' . $group->image2);
        }
        if ($group->image3 !== null) {
            Storage::delete('public/' . $group->image3);
        }
        if ($group->image4 !== null) {
            Storage::delete('public/' . $group->image4);
        }

        $group->delete();

        return redirect()->route('mygroups.index')->with('success', 'Группа удалена');
    }
}
