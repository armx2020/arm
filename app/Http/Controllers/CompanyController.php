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

    public function index(Request $request)
    {
        return view('pages.company.companies', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
        ]);
    }

    public function show(Request $request, $id)
    {
        $company = Company::with('events', 'projects', 'vacancies', 'news', 'offers')->find($id);

        if (empty($company)) {
            return redirect()->route('companies.index')->with('alert', 'Компания не найдена');
        }

        return view('pages.company.company', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'company' => $company,
        ]);
    }
}
