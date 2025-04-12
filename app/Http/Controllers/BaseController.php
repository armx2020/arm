<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

abstract class BaseController extends Controller
{
    protected $regions = [];
    protected $countries = [];

    protected $quantityOfDisplayed = 20; // Количество отоброжаемых сущностей

    public function __construct()
    {
        $this->regions = Cache::get('regions', []);
        $this->countries = Cache::get('countries', []);

        if (empty($this->regions) || empty($this->countries)) {
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
            $request->session()->put('lat', $region->lat);
            $request->session()->put('lon', $region->lon);
        } else {

            $region = $regionsCollect->firstWhere('transcription', 'like', $regionTranslit);

            if ($region) {
                $request->session()->put('regionName', $region->name);
                $request->session()->put('regionTranslit', $region->transcription);
                $request->session()->put('lat', $region->lat);
                $request->session()->put('lon', $region->lon);
            } else {
                $citiesCollect = collect(Cache::get('all_cities', []));
                $city = $citiesCollect->firstWhere('transcription', 'like', $regionTranslit);

                if ($city) {
                    $request->session()->put('regionName', $city->region->name);
                    $request->session()->put('regionTranslit', $city->region->transcription);
                    $request->session()->put('lat', $city->lat);
                    $request->session()->put('lon', $city->lon);

                    $region = $city->region;
                } else {

                    $region = $regionsCollect->firstWhere('id', 1);

                    $countriesCollect = collect(Cache::get('all_countries', []));
                    $country = $countriesCollect->firstWhere('code', 'like', $regionTranslit);

                    if ($country) {
                        if ($country->code == 'ru') {
                            $request->session()->put('regionName', $region->name);
                            $request->session()->put('regionTranslit', $region->transcription);
                            $request->session()->put('lat', $region->lat);
                            $request->session()->put('lon', $region->lon);
                        } else {
                            $request->session()->put('regionName', $country->name_ru);
                            $request->session()->put('regionTranslit', $country->code);
                            $request->session()->put('lat', $country->lat);
                            $request->session()->put('lon', $country->lon);
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
