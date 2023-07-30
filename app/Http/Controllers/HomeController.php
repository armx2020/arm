<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome()
    {
        return redirect()->route('home');
    }


    public function home(Request $request)
    {
        $cities = City::all()->sortBy('name')
                            ->groupBy(function($item) { 
            return mb_substr($item->name, 0, 1); 
        });

        return view('home', [
            'city'   => $request->session()->get('city'),
            'region' => $request->session()->get('region'),
            'regionId' => $request->session()->get('regionId'),
            'cities' => $cities,
        ]);
    }

    public function changeCity(Request $request, $id)
    {
        $city = City::with('region')->find($id);

        $request->session()->put('city', $city->name);
        $request->session()->put('region', $city->region->name);

        return redirect()->back();
    }
}
