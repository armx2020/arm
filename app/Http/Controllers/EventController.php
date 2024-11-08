<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        return view('pages.event.events', [
            'city'   => $request->session()->get('city'),
            'cities' => $cities
        ]);
    }

    public function show(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $event = Event::with('parent')->find($id);

        if (empty($event)) {
            return redirect()->route('myevents.index')->with('alert', 'Мероприятие не найдено');
        }

        return view('pages.event.event', [
            'city'   => $request->session()->get('city'),
            'event'   => $event,
            'cities' => $cities
        ]);
    }
}
