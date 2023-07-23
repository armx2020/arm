<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    public function index(Request $request)
    {   
        $city = City::where('InEnglish', '=', $request->session()->get('city'))->First();

        if (empty($city)) {
            $cityName = City::find(1);
        } else {
            $cityName = $city->name;
        }

        return view('pages.offer.offers', ['city' => $cityName]);
    }
}
