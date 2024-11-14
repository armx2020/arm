<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Models\Region;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home(Request $request, $regionCode = null)
    {
        $group = Group::find($this->getRegionId($request, $regionCode));

        return view('home', [
            'region'   => $request->session()->get('region'),
            'group' => $group,
            'regions' => $this->regions,
        ]);
    }

    public function privacyPolicy(Request $request)
    {
        return view('pages.privacy-policy', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
        ]);
    }

    public function conditionOfUse(Request $request)
    {
        return view('pages.condition-of-use', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
        ]);
    }

    public function getRegionId(Request $request, $regionCode = null)
    {
        $region = Region::where('code', $regionCode)->First();

        if (empty($region)) {
            return redirect()->route('home');
        }

        $request->session()->put('region', $region->name);
        $request->session()->put('regionId', $region->code);

        return $region->id;
    }
}
