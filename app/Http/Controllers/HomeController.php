<?php

namespace App\Http\Controllers;

use App\Models\City;
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
        $city = City::with('region')->where('InEnglish', 'like', $request->session()->get('city'))->First();

         if(empty($city)) {
            $cityName = City::find(1);
            $region = Region::find(1);
        } else {
            $cityName = $city->name;
            $region = $city->region;
        }

        return view('home', ['city' => $cityName, 'region' => $region]);
    }

    public function changeCity(Request $request)
    {
        $city = City::with('region')->find($request->query('city'));

        $request->session()->put('city', $city->InEnglish);
        $request->session()->put('region', $city->region->InEnglish);

        return redirect()->back();
    }
}
