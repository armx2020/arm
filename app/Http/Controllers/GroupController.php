<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Group;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        return view('pages.group.groups', [
            'city'   => $request->session()->get('city'),
            'cities' => $cities,
        ]);
    }

    public function show(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $group = Group::with('events', 'projects', 'vacancies', 'news')->find($id);

        if (empty($group)) {
            return redirect()->route('groups.index')->with('alert', 'Группа не найдена');
        }

        $sum =  ($group->address ? 10 : 0) +
            ($group->description ? 10 : 0) +
            ($group->image ? 10 : 0) +
            ($group->phone ? 5 : 0) +
            ($group->web ? 5 : 0) +
            ($group->viber ? 5 : 0) +
            ($group->whatsapp ? 5 : 0) +
            ($group->instagram ? 5 : 0) +
            ($group->vkontakte ? 5 : 0) +
            ($group->telegram ? 5 : 0);

        $fullness = (round(($sum / 65) * 100));

        return view('pages.group.group', [
            'city'   => $request->session()->get('city'),
            'group' => $group,
            'fullness' => $fullness,
            'cities' => $cities
        ]);
    }

    public function places(Request $request)
    {
        $request->session()->put('filter', 'places');
        return redirect()->route('group.index');
    }

    public function religion(Request $request)
    {
        $request->session()->put('filter', 'religion');
        return redirect()->route('group.index');
    }
}
