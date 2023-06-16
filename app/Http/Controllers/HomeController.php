<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class HomeController extends Controller
{

    public function home($param)
    {
        $city = City::where('InEnglish', '=', $param)->First();
        
        $cityName = null;

        if ($city !== null) {
            $cityName = $city->name;
        }  

        return view('home', ['city' => $cityName]);
    }

    public function main(Request $request)
    {
        $city = City::findOrFail($request->query('city'));

        $cityName = $city->InEnglish == 'no selected' ? 'russia' : $city->InEnglish;

        return redirect()->route('home', ['city' => $cityName]);
    }
}
