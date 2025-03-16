<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

abstract class BaseController extends Controller
{
    protected $regions = [];

    protected $quantityOfDisplayed = 20; // Количество отоброжаемых сущностей

    public function __construct()
    {
        $this->regions = Cache::get('regions', []);

        if (empty($this->regions)) {
            Artisan::call('cache-regions');
        }
    }

    public function getRegion($request, $regionTranslit = null)
    {
        $regionsCollect = collect(Cache::get('all_regions', []));

        if ($regionsCollect->isEmpty()) {
            Artisan::call('cache-regions');
        }

        if ($regionTranslit == null) {

            $region = $regionsCollect->firstWhere('id', 1);

            $request->session()->put('regionName', $region->name);
            $request->session()->put('regionTranslit', $region->transcription);
        } else {

            $region = $regionsCollect->firstWhere('transcription', 'like', $regionTranslit);

            if ($region) {
                $request->session()->put('regionName', $region->name);
                $request->session()->put('regionTranslit', $region->transcription);
            } else {
                $citiesCollect = collect(Cache::get('all_cities', []));
                $city = $citiesCollect->firstWhere('transcription', 'like', $regionTranslit);

                if ($city) {
                    $request->session()->put('regionName', $city->region->name);
                    $request->session()->put('regionTranslit', $city->region->transcription);

                    $region = $city->region;
                } else {

                    $region = $regionsCollect->firstWhere('id', 1);

                    $countriesCollect = collect(Cache::get('all_countries', []));
                    $country = $countriesCollect->firstWhere('code', 'like', $regionTranslit);

                    if ($country) {
                        if ($country->code == 'ru') {
                            $request->session()->put('regionName', $region->name);
                            $request->session()->put('regionTranslit', $region->transcription);
                        } else {
                            $request->session()->put('regionName', $country->name_ru);
                            $request->session()->put('regionTranslit', $country->code);
                        }
                    } else {
                        return null;
                    }
                }
            }
        }

        return $region;
    }
}
