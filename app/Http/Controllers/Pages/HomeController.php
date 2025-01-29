<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\BaseController;
use App\Models\Entity;
use Illuminate\Http\Request;

class HomeController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function home(Request $request, $regionTranslit = null)
    {
        $region = $this->getRegion($request, $regionTranslit);

        $group = Entity::groups()->where('region_id', $region->id)->first();

        if (empty($group)) {
            $group = Entity::where('region_id', 1)->first();
        }

        return view('home', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'group' => $group,
            'regions' => $this->regions,
        ]);
    }

    public function privacyPolicy(Request $request)
    {
        return view('pages.privacy-policy', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
        ]);
    }

    public function conditionOfUse(Request $request)
    {
        return view('pages.condition-of-use', [
            'region'   => $request->session()->get('regionTranslit'),
            'regionName' => $request->session()->get('regionName'),
            'regions' => $this->regions,
        ]);
    }
}
