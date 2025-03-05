<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\City;
use Illuminate\Support\Facades\Artisan;
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
        $regionsCollect = collect(Cache::get('all_regions', []));

        if ($regionsCollect->isEmpty()) {
            Artisan::call('cache-regions');
        }

        if ($regionTranslit == null) {

            $region = $regionsCollect->firstWhere('transcription', 'like', 'russia');

            $request->session()->put('regionName', $region->name);
            $request->session()->put('regionTranslit', $region->transcription);
        } else {

            $region = $regionsCollect->firstWhere('transcription', 'like', $regionTranslit);

            if ($region) {
                $request->session()->put('regionName', $region->name);
                $request->session()->put('regionTranslit', $region->transcription);
            } else {
                $city = City::select('id', 'name', 'transcription', 'region_id')->with('region')->where('transcription', 'like', $regionTranslit)->First();

                $citiesCollect = collect(Cache::get('all_cities', []));
                $city = $citiesCollect->firstWhere('transcription', 'like', $regionTranslit);

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
