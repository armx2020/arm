<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\BaseController;
use Illuminate\Http\Request;
use App\Models\Group;

class GroupController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request, $regionCode = null)
    {
        $secondPositionUrl = 'grouos.index';
        $secondPositionName = 'Группы';
        $entity = 'groups';

        return view('pages.group.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $regionCode,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
        ]);
    }

    public function show(Request $request, $id)
    {
        $group = Group::with('events', 'projects', 'works', 'news', 'users')->find($id);

        if (empty($group)) {
            return redirect()->route('groups.index')->with('alert', 'Группа не найдена');
        }

        return view('pages.group.show', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'entity' => $group,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function places(Request $request)
    {
        $request->session()->put('filter', 'places');
        return redirect()->route('groups.index');
    }
}
