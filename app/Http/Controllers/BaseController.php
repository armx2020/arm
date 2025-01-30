<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Region;

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

    public function getRegion($request, $regionTranslit = null)
    {
        if ($regionTranslit == null) {
            $region = Region::find(1);
            $request->session()->put('regionName', $region->name);
            $request->session()->put('regionTranslit', $region->transcription);
        } else {
            $region = Region::where('transcription', 'like', $regionTranslit)->First();

            if ($region) {
                $request->session()->put('regionName', $region->name);
                $request->session()->put('regionTranslit', $region->transcription);
            } else {
                $city = City::where('transcription', 'like', $regionTranslit)->First();

                if ($city) {
                    $request->session()->put('regionName', $city->region->name);
                    $request->session()->put('regionTranslit', $city->region->transcription);

                    $region = $city->region;
                } else {
                    return null;
                }
            }
        }

        return $region;
    }
}
