<?php

namespace App\Http\Controllers\Pages;

use App\Http\Controllers\BaseController;
use App\Models\Event;
use Illuminate\Http\Request;

class EventController extends BaseController
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index(Request $request, $regionCode = null)
    {
        return view('pages.event.index', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'regionCode' => $regionCode
        ]);
    }

    public function show(Request $request, $id)
    {
        $event = Event::with('parent')->find($id);

        if (empty($event)) {
            return redirect()->route('myevents.index')->with('alert', 'Мероприятие не найдено');
        }

        return view('pages.event.show', [
            'region'   => $request->session()->get('region'),
            'regions' => $this->regions,
            'entity'   => $event,
            'regionCode' => $request->session()->get('regionId')
        ]);
    }
}
