<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\BaseAdminController;
use App\Models\Entity;
use App\Models\Event;
use App\Models\User;


class DashboardController extends BaseAdminController
{
    public function index()
    {
        $countUsersAll = User::all()->count();
        $countUsersToday = User::whereDate('created_at', '=', date("Y-m-d"))->count();

        $countCompaniesAll = Entity::companies()->count();
        $countCompaniesToday = Entity::companies()->whereDate('created_at', '=', date("Y-m-d"))->count();

        $countGroupsAll = Entity::groups()->count();
        $countGroupsToday = Entity::groups()->whereDate('created_at', '=', date("Y-m-d"))->count();

        $users = User::orderBy('id', 'desc')->limit(5)->get();

        return view('admin.dashboard', [
            'countUsersAll' => $countUsersAll,
            'countUsersToday' => $countUsersToday,
            'countCompaniesAll' => $countCompaniesAll,
            'countCompaniesToday' => $countCompaniesToday,
            'countGroupsAll' => $countGroupsAll,
            'countGroupsToday' => $countGroupsToday,
            'users' => $users,
            'menu' => $this->menu
        ]);
    }
}
