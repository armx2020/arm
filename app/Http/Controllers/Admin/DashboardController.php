<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Company;
use App\Models\Event;
use App\Models\Group;
use App\Models\User;


class DashboardController extends Controller
{
    public function index()
    {
        $countUsersAll = User::all()->count();
        $countUsersToday = User::whereDate('created_at', '=', date("Y-m-d"))->count();

        $countCompaniesAll = Company::all()->count();
        $countCompaniesToday = Company::whereDate('created_at', '=', date("Y-m-d"))->count();

        $countGroupsAll = Group::all()->count();
        $countGroupsToday = Group::whereDate('created_at', '=', date("Y-m-d"))->count();

        $events = Event::with('parent')->limit(5)->get();

        $users = User::orderBy('id', 'desc')->limit(5)->get();

        return view('admin.dashboard', [
            'countUsersAll' => $countUsersAll,
            'countUsersToday' => $countUsersToday,
            'countCompaniesAll' => $countCompaniesAll,
            'countCompaniesToday' => $countCompaniesToday,
            'countGroupsAll' => $countGroupsAll,
            'countGroupsToday' => $countGroupsToday,
            'events' => $events,
            'users' => $users
        ]);
    }
}
