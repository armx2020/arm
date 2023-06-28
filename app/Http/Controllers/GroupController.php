<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\City;

class GroupController extends Controller
{
    public function index(Request $request)
    {   
        $city = City::where('InEnglish', '=', $request->session()->get('city'))->First();
      
        $cityName = null;

        if ($city !== null) {
            $cityName = $city->name;
        }  

        return view('group', ['city' => $cityName]);
    }
}
