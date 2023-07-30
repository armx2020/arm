<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        return view('company', [
            'city'   => $request->session()->get('city'),
            'cities' => $cities
        ]);
    }
}
