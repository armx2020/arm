<?php

namespace App\Http\Controllers;

use App\Models\City;
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
 
        $cityName = null;

        if ($city !== null) {
            $cityName = $city->name;
        }  

        return view('home', ['city' => $cityName]);
    }

    public function changeCity(Request $request)
    {
        $city = City::findOrFail($request->query('city'));
        
        $request->session()->put('city', $city->InEnglish);

        return redirect()->route('home');
    }
}
