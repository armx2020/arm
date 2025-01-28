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

    public function getRegion($request, $region = null)
    {
        if (empty($region)) {
            $region = Region::find(1);
            $request->session()->put('regionName', $region->name);
            $request->session()->put('region', $region->transcription);
        } else {
            $region = Region::where('transcription', 'like', $region)->First();

            if ($region) {
                $request->session()->put('regionName', $region->name);
                $request->session()->put('region', $region->transcription);
            } else {
                return redirect()->route('home');
            }
        }

        return $region;
    }
}
