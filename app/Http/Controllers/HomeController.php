<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Group;
use App\Models\Region;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $region = Region::where('name', 'like', $request->session()->get('region'))->First();

        if (empty($region)) {
            $region = Region::find(1);
        }

        $group = Group::find($region->id);
        
        return view('home', [
            'city'   => $request->session()->get('city'),
            'region' => $request->session()->get('region'),
            'group' => $group,
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
