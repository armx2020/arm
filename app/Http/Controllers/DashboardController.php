<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index(Request $request)
    {   
        $city = City::where('InEnglish', '=', $request->session()->get('city'))->First();
      
        $cityName = null;

        if ($city !== null) {
            $cityName = $city->name;
        }

        $sum =  (Auth::user()->city !== 1 ? 10 : 0) +
                    (Auth::user()->image ? 10 : 0) +
                    (Auth::user()->viber ? 5 : 0) +
                    (Auth::user()->whatsapp ? 5 : 0) +
                    (Auth::user()->instagram ? 5 : 0) +
                    (Auth::user()->vkontakte ? 5 : 0) +
                    (Auth::user()->telegram ? 5 : 0);

            $fullness = (round(($sum / 45)*100));

        return view('dashboard', ['city' => $cityName, 'fullness' => $fullness]);
    }
}
