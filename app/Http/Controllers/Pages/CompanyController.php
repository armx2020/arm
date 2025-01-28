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

    public function index(Request $request, $region = null)
    {
        $secondPositionUrl = 'companies.index';
        $secondPositionName = 'Компании';
        $entity = 'companies';

        $region = $this->getRegion($request, $region);

        return view('pages.company.index', [
            'region'   => $request->session()->get('region'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
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
