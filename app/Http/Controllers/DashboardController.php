<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $sum =  (Auth::user()->city !== 1 ? 10 : 0) +
            (Auth::user()->image ? 10 : 0) +
            (Auth::user()->viber ? 5 : 0) +
            (Auth::user()->whatsapp ? 5 : 0) +
            (Auth::user()->instagram ? 5 : 0) +
            (Auth::user()->vkontakte ? 5 : 0) +
            (Auth::user()->telegram ? 5 : 0);

        $fullness = (round(($sum / 45) * 100));

        return view('dashboard', [
            'city'   => $request->session()->get('city'),
            'fullness' => $fullness,
            'cities' => $cities
        ]);
    }
}
