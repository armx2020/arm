<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Stevebauman\Location\Facades\Location;

class HomeController extends Controller
{
    public function welcome()
    {
        $ip = $_SERVER['REMOTE_ADDR'];
        $data = Location::get('46.16.8.255');

        if ($data == false) {
            $city = 'rus';
        } else {
            $city = $data->cityName;
        }

        return redirect()->route('home', ['city' => $city]);
    }

    public function home($city)
    {
        return view('welcome');
    }
}
