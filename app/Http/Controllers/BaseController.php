<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Region;
use Illuminate\Support\Facades\Cache;

abstract class BaseController extends Controller
{
    protected $regions = [];
    
    protected $quantityOfDisplayed = 20; // Количество отоброжаемых сущностей

    public function __construct()
    {
        $this->regions = Cache::get('regions', []);
    }

    public function getRegion($request, $regionTranslit = null)
    {
        if ($regionTranslit == null) {
            $region = Region::select('id', 'name', 'transcription')->find(1);
            $request->session()->put('regionName', $region->name);
            $request->session()->put('regionTranslit', $region->transcription);
        } else {
            $region = Region::select('id', 'name', 'transcription')->where('transcription', 'like', $regionTranslit)->First();

            if ($region) {
                $request->session()->put('regionName', $region->name);
                $request->session()->put('regionTranslit', $region->transcription);
            } else {
                $city = City::select('id', 'name', 'transcription')->where('transcription', 'like', $regionTranslit)->First();

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
