<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Region;
use Stevebauman\Location\Facades\Location;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function welcome()
    {
        return redirect()->route('home');
    }


    public function home(Request $request)
    {
        $city = City::where('InEnglish', 'like', $request->session()->get('city'))->First();
        $region = Region::where('InEnglish', '=', $request->session()->get('region'))->First();

        $cityName = null;

        if ($city !== null) {
            $cityName = $city->name;
        }

        if(empty($region)) {
            $region = Region::where('InEnglish', '=', 'Russia')->First();
        }

        return view('home', ['city' => $cityName, 'region' => $region]);
    }

    public function changeCity(Request $request)
    {
        $city = City::with('region')->findOrFail($request->query('city'));

        $request->session()->put('city', $city->InEnglish);
        $request->session()->put('region', $city->region->InEnglish);

        return redirect()->back();
    }
}
