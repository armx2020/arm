<?php

namespace App\Http\Middleware;

use App\Models\City;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Stevebauman\Location\Facades\Location;

class FromLocation
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (!$request->session()->has('city')) {

            $ip = $_SERVER['REMOTE_ADDR'];
            $data = Location::get($ip);

            $cityName = $data ? $data->cityName : 'no selected';


            $city = City::with('region')->where('InEnglish', 'like', $cityName)->First();

            if (empty($city)) {
                $city = City::find(1);
            }

            $cityName = $city->name;
            $regionName = $city->region->name;
            $regionId = $city->region->id;

            $request->session()->put('city', $cityName);
            $request->session()->put('region', $regionName);
            $request->session()->put('regionId', $regionId);
        }

        return $next($request);
    }
}
