<?php

namespace App\Http\Middleware;

use App\Models\City;
use App\Models\Region;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Stevebauman\Location\Facades\Location;

class FromLocation
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('region')) {

            $ip = $_SERVER['REMOTE_ADDR'];
            $data = Location::get($ip);

            $regionName = $data ? $data->regionName : 'Russia';

            $region = Region::where('InEnglish', 'like', $regionName)->First();

            if (empty($city)) {
                $region = Region::find(1);
            }

            $regionName = $region->name;
            $code = $region->code;

            $request->session()->put('region', $regionName);
            $request->session()->put('regionId', $code);
        }

        return $next($request);
    }
}
