<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Region;
use Illuminate\Http\Client\Request;

abstract class BaseController extends Controller
{
    protected $regions = [];

    public function __construct()
    {
        $this->regions = Region::whereNot('code', 0)->get()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });
    }

    public function getRegion($request, $regionCode = null)
    {
        if (!$regionCode) {
            $region = Region::find(1);
            $request->session()->put('region', $region->name);
            $request->session()->put('regionId', $region->code);
        } else {
            $region = Region::where('code', 'like', $regionCode)->First();

            if ($region) {
                $request->session()->put('region', $region->name);
                $request->session()->put('regionId', $region->code);
            } else {
                return redirect()->route('home');
            }
        }

        return $region;
    }
}
