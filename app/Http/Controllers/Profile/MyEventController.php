<?php

namespace App\Http\Controllers\Profile;

use App\Http\Controllers\Controller;
use App\Models\City;
use App\Models\Company;
use App\Models\Event;
use App\Models\Group;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class MyEventController extends Controller
{
    public function index(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $groups = Group::where('user_id', '=', Auth::user()->id)->with('events')->get();
        $companies = Company::where('user_id', '=', Auth::user()->id)->with('events')->get();
        $events = Auth::user()->events;

        return view('profile.pages.event.index', [
            'city'      => $request->session()->get('city'),
            'groups'    => $groups,
            'companies' => $companies,
            'events'    => $events,
            'cities'    => $cities
        ]);
    }

    public function create(Request $request)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $companies = Company::where('user_id', '=', Auth::user()->id)->get();
        $groups = Group::where('user_id', '=', Auth::user()->id)->get();

        return view('profile.pages.event.create', [
            'city'      => $request->session()->get('city'),
            'companies' => $companies,
            'groups'    => $groups,
            'cities'    => $cities
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'address' => ['max:128'],
            'image' => ['image', 'max:2048'],
            'image1' => ['image', 'max:2048'],
            'image2' => ['image', 'max:2048'],
            'image3' => ['image', 'max:2048'],
            'image4' => ['image', 'max:2048'],
        ]);

        $city = City::with('region')->find($request->news_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $event = new Event();

        $event->name = $request->name;
        $event->description = $request->description;
        $event->address = $request->address;
        $event->date_to_start = $request->date_to_start;
        $event->city_id = $request->event_city;
        $event->region_id = $city->region->id;

        $parent = $request->parent;
        $parent_explode = explode('|', $parent);

        if ($parent_explode[0] == 'User') {
            $event->parent_type = 'App\Models\User';
            $event->parent_id = $parent_explode[1];
        } elseif ($parent_explode[0] == 'Company') {
            $event->parent_type = 'App\Models\Company';
            $event->parent_id = $parent_explode[1];
        } elseif ($parent_explode[0] == 'Group') {
            $event->parent_type = 'App\Models\Group';
            $event->parent_id = $parent_explode[1];
        } else {
            $event->parent_type = 'App\Models\Admin';
            $event->parent_id = 1;
        }


        if ($request->image) {
            $event->image = $request->file('image')->store('events', 'public');
        }

        $event->save();

        return redirect()->route('myevents.index')->with('success', 'Мероприятие "' . $event->name . '" добавлено');
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
        } else {
            if (
                ($event->parent_type == 'App\Models\User' && $event->parent_id == Auth::user()->id) ||
                ($event->parent_type == 'App\Models\Company' && $event->parent->user_id == Auth::user()->id) ||
                ($event->parent_type == 'App\Models\Group' && $event->parent->user_id == Auth::user()->id)
            ) {
                return view('profile.pages.event.show', [
                    'city'   => $request->session()->get('city'),
                    'event'   => $event,
                    'cities' => $cities
                ]);
            } else {
                return redirect()->route('myevents.index')->with('alert', 'Мероприятие не найдено');
            }
        }
    }

    public function edit(Request $request, $id)
    {
        $cities = City::all()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $event = Event::with('parent')->find($id);

        if (empty($event)) {
            return redirect()->route('myevents.index')->with('alert', 'Мероприятие не найдено');
        } else {
            if (
                ($event->parent_type == 'App\Models\User' && $event->parent_id == Auth::user()->id) ||
                ($event->parent_type == 'App\Models\Company' && $event->parent->user_id == Auth::user()->id) ||
                ($event->parent_type == 'App\Models\Group' && $event->parent->user_id == Auth::user()->id)
            ) {
                $companies = Company::where('user_id', '=', Auth::user()->id)->get();
                $groups = Group::where('user_id', '=', Auth::user()->id)->get();

                return view('profile.pages.event.edit', [
                    'city'   => $request->session()->get('city'),
                    'event'  => $event,
                    'cities' => $cities,
                    'companies' => $companies,
                    'groups'    => $groups,
                ]);
            } else {
                return redirect()->route('mynevents.index')->with('alert', 'Мероприятие не найдено');
            }
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:40'],
            'image' => ['image', 'max:2048'],
            'image1' => ['image', 'max:2048'],
            'image2' => ['image', 'max:2048'],
            'image3' => ['image', 'max:2048'],
            'image4' => ['image', 'max:2048'],
        ]);

        $city = City::with('region')->find($request->news_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $event = Event::with('parent')->find($id);

        if (empty($event)) {
            return redirect()->route('myevents.index')->with('alert', 'Мероприятие не найдено');
        } else {
            if (
                ($event->parent_type == 'App\Models\User' && $event->parent_id == Auth::user()->id) ||
                ($event->parent_type == 'App\Models\Company' && $event->parent->user_id == Auth::user()->id) ||
                ($event->parent_type == 'App\Models\Group' && $event->parent->user_id == Auth::user()->id)
            ) {
                $event->name = $request->name;
                $event->description = $request->description;
                $event->address = $request->address;
                $event->date_to_start = $request->date_to_start;
                $event->city_id = $request->event_city;
                $event->region_id = $city->region->id;

                $parent = $request->parent;
                $parent_explode = explode('|', $parent);

                if ($parent_explode[0] == 'User') {
                    $event->parent_type = 'App\Models\User';
                    $event->parent_id = $parent_explode[1];
                } elseif ($parent_explode[0] == 'Company') {
                    $event->parent_type = 'App\Models\Company';
                    $event->parent_id = $parent_explode[1];
                } elseif ($parent_explode[0] == 'Group') {
                    $event->parent_type = 'App\Models\Group';
                    $event->parent_id = $parent_explode[1];
                } else {
                    $event->parent_type = 'App\Models\Admin';
                    $event->parent_id = 1;
                }

                if ($request->image_r == 'delete') {
                    Storage::delete('public/' . $event->image);
                    $event->image = null;
                }
                if ($request->image) {
                    Storage::delete('public/' . $event->image);
                    $event->image = $request->file('image')->store('events', 'public');
                }

                $event->update();

                return redirect()->route('myevents.index')->with('success', 'Мероприятие "' . $event->name . '" обновлено');
            } else {
                return redirect()->route('mynevents.index')->with('alert', 'Мероприятие не найдено');
            }
        }
    }

    public function destroy($id)
    {
        $event = Event::with('parent')->find($id);

        if (empty($event)) {
            return redirect()->route('myevents.index')->with('alert', 'Мероприятие не найдено');
        } else {
            if (
                ($event->parent_type == 'App\Models\User' && $event->parent_id == Auth::user()->id) ||
                ($event->parent_type == 'App\Models\Company' && $event->parent->user_id == Auth::user()->id) ||
                ($event->parent_type == 'App\Models\Group' && $event->parent->user_id == Auth::user()->id)
            ) {

                if ($event->image) {
                    Storage::delete('public/' . $event->image);
                }

                $event->delete();

                return redirect()->route('myevents.index')->with('success', 'Мероприятие удалено');
            } else {
                return redirect()->route('mynevents.index')->with('alert', 'Мероприятие не найдено');
            }
        }
    }
}
