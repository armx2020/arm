<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\BaseController;
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
        $secondPositionUrl = 'companies.index';
        $secondPositionName = 'Компании';
        $entity = 'companies';

        return view('pages.company.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $regionCode,
            'secondPositionUrl' => $secondPositionUrl,
            'secondPositionName' => $secondPositionName,
            'entity' => $entity,
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
            'entity' => $company,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }
}
