<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Group;
use App\Models\Region;
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
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $region = Region::where('name', 'like', $request->session()->get('region'))->First();

        if (empty($region)) {
            $region = Region::find(1);
        }

        $group = Group::find($region->id);

        return view('home', [
            'city'   => $request->session()->get('city'),
            'group' => $group,
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

    public function privacyPolicy(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });
            

        return view('pages.privacy-policy', [
            'city'   => $request->session()->get('city'),
            'cities' => $cities,
        ]);
    }

    public function conditionOfUse(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });
            

        return view('pages.condition-of-use', [
            'city'   => $request->session()->get('city'),
            'cities' => $cities,
        ]);
    }
}
