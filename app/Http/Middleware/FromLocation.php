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
        $ip = $_SERVER['REMOTE_ADDR'];
        $data = Location::get($ip);

        $cityName = $data ? $data->cityName : 'russia';

        return redirect()->route('home', ['city' => $cityName]);

        //return $next($request);
    }
}
