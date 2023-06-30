<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {   
        $city = City::where('InEnglish', '=', $request->session()->get('city'))->First();
      
        $cityName = null;

        if ($city !== null) {
            $cityName = $city->name;
        }  

        return view('company', ['city' => $cityName]);
    }
}
