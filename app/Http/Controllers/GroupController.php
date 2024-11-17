<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Group;
use Illuminate\Support\Facades\Auth;

class GroupController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request, $regionCode = null)
    {
        return view('pages.group.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $regionCode
        ]);
    }

    public function show(Request $request, $id)
    {
        $group = Group::with('events', 'projects', 'works', 'news', 'users')->find($id);

        if (empty($group)) {
            return redirect()->route('groups.index')->with('alert', 'Группа не найдена');
        }

        $subscribe = false;

        if (Auth::check()) {
            if ($group->signed(Auth::user())) {
                $subscribe = true;
            }
        }

        return view('pages.group.show', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'group' => $group,
            'subscribe' => $subscribe,
            'regionCode' => $request->session()->get('regionId')
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
            return redirect()->route('groups.show', ['id' => $group->id])->with('alert', 'Необходимо войти');
        }

        if ($group->isOfThe(Auth::user())) {
            return redirect()->route('groups.show', ['id' => $group->id])->with('alert', 'Вы уже подписаны');
        }

        $group->users()->attach(Auth::user()->id);

        return redirect()->route('groups.show', ['id' => $group->id])->with('success', 'Вы успешно подписались');
    }

    public function unsubscribe($id)
    {
        $group = Group::find($id);

        if (empty($group)) {
            return redirect()->route('groups.index')->with('alert', 'Группа не найдена');
        }

        if (!Auth::check()) {
            return redirect()->route('groups.show', ['id' => $group->id])->with('alert', 'Необходимо войти');
        }

        if (!$group->isOfThe(Auth::user())) {
            return redirect()->route('groups.show', ['id' => $group->id])->with('alert', 'Вы уже подписаны');
        }

        $group->users()->detach(Auth::user()->id);

        return redirect()->route('groups.show', ['id' => $group->id])->with('success', 'Вы успешно отписались');
    }
}
