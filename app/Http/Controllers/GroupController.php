<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;
use App\Models\Group;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class GroupController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        return view('pages.group.index', [
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

        $group = Group::with('events', 'projects', 'vacancies', 'news', 'users')->find($id);

        if (empty($group)) {
            return redirect()->route('groups.index')->with('alert', 'Группа не найдена');
        }


        $subscribe = false;

        if (Auth::check()) {
            if ($group->isOfThe(Auth::user())) {
                $subscribe = true;
            }
        }

        return view('pages.group.show', [
            'city'   => $request->session()->get('city'),
            'group' => $group,
            'subscribe' => $subscribe,
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

    public function subscribe($id)
    {
        $group = Group::find($id);

        if (empty($group)) {
            return redirect()->route('groups.index')->with('alert', 'Группа не найдена');
        }

        if (!Auth::check()) {
            return redirect()->route('group.show', ['id' => $group->id])->with('alert', 'Необходимо войти');
        }

        if ($group->isOfThe(Auth::user())) {
            return redirect()->route('group.show', ['id' => $group->id])->with('alert', 'Вы уже подписаны');
        }

        $group->users()->attach(Auth::user()->id);

        return redirect()->route('group.show', ['id' => $group->id])->with('success', 'Вы успешно подписались');
    }

    public function unsubscribe($id)
    {
        
        $group = Group::find($id);

        if (empty($group)) {
            return redirect()->route('groups.index')->with('alert', 'Группа не найдена');
        }

        $group->users()->detach(Auth::user()->id);

        return redirect()->route('group.show', ['id' => $group->id])->with('success', 'Вы успешно отписались');
    }
}
