<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request, $regionCode = null)
    {
        return view('pages.company.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $regionCode
        ]);
    }

    public function show(Request $request, $id)
    {
        $company = Company::with('events', 'projects', 'works', 'news', 'offers')->find($id);

        if (empty($company)) {
            return redirect()->route('companies.index')->with('alert', 'Компания не найдена');
        }

        return view('pages.company.show', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'company' => $company,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }
}
