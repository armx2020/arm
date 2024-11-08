<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        return view('pages.company.companies', [
            'city'   => $request->session()->get('city'),
            'cities' => $cities,
        ]);
    }

    public function show(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $company = Company::with('events', 'projects', 'vacancies', 'news', 'offers')->find($id);

        if (empty($company)) {
            return redirect()->route('company.index')->with('alert', 'Компания не найдена');
        }

        return view('pages.company.company', [
            'city'   => $request->session()->get('city'),
            'company' => $company,
            'cities' => $cities
        ]);
    }
}
