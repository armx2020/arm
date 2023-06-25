<?php

namespace App\Http\Middleware;

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
            $regionName = $data ? $data->regionName : 'Russia';

            $request->session()->put('city', $cityName);
            $request->session()->put('region', $regionName);
        }

        return $next($request);
    }
}
