<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\BaseController;
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
        if (!$regionCode) {
            $region = Region::find(1);
            $request->session()->put('region', $region->name);
            $request->session()->put('regionId', $region->code);
        } else {
            $region = Region::where('code', 'like', $regionCode)->First();

            if($region) {
                $request->session()->put('region', $region->name);
                $request->session()->put('regionId', $region->code);
            } else {
                return redirect()->route('home');
            }
        }

        $group = Group::find($region->id);

        return view('home', [
            'region'   => $request->session()->get('region'),
            'group' => $group,
            'regions' => $this->regions,
            'regionCode' => $regionCode
        ]);
    }

    public function privacyPolicy(Request $request)
    {
        return view('pages.privacy-policy', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }

    public function conditionOfUse(Request $request)
    {
        return view('pages.condition-of-use', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }
}
