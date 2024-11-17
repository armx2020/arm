<?php

namespace App\Http\Controllers;

use App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request)
    {
        $sum =  (Auth::user()->city !== 1 ? 10 : 0) +
            (Auth::user()->image ? 10 : 0) +
            (Auth::user()->viber ? 5 : 0) +
            (Auth::user()->whatsapp ? 5 : 0) +
            (Auth::user()->instagram ? 5 : 0) +
            (Auth::user()->vkontakte ? 5 : 0) +
            (Auth::user()->telegram ? 5 : 0);

        $fullness = (round(($sum / 45) * 100));

        return view('dashboard', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'fullness' => $fullness,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function questions(Request $request)
    {
        return view('profile.pages.questions', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }
}
