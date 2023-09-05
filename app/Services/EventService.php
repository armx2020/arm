<?php

namespace App\Services;

use App\Models\City;
use App\Models\Event;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class EventService
{
    public function store($request): Event
    {
        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $event = new Event();

        $event->name = $request->name;
        $event->address = $request->address;
        $event->description = $request->description;
        $event->city_id = $request->city;
        $event->region_id = $city->region->id;
        $event->date_to_start = $request->date_to_start;

        if ($request->parent == 'User') {
            $event->parent_type = 'App\Models\User';
            $event->parent_id = $request->user;
        } elseif ($request->parent == 'Company') {
            $event->parent_type = 'App\Models\Company';
            $event->parent_id = $request->company;
        } elseif ($request->parent == 'Group') {
            $event->parent_type = 'App\Models\Group';
            $event->parent_id = $request->group;
        } else {
            $event->parent_type = 'App\Models\Admin';
            $event->parent_id = 1;
        }

        if ($request->image) {
            $event->image = $request->file('image')->store('events', 'public');
            Image::make('storage/'.$event->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $event->save();

        return $event;
    }

    public function update($request, $event): Event
    {
        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $event->name = $request->name;
        $event->address = $request->address;
        $event->description = $request->description;
        $event->city_id = $request->city;
        $event->region_id = $city->region->id;
        $event->date_to_start = $request->date_to_start;

        if ($request->parent == 'User') {
            $event->parent_type = 'App\Models\User';
            $event->parent_id = $request->user;
        } elseif ($request->parent == 'Company') {
            $event->parent_type = 'App\Models\Company';
            $event->parent_id = $request->company;
        } elseif ($request->parent == 'Group') {
            $event->parent_type = 'App\Models\Group';
            $event->parent_id = $request->group;
        } else {
            $event->parent_type = 'App\Models\Admin';
            $event->parent_id = 1;
        }

        if ($request->image) {
            Storage::delete('public/' . $event->image);
            $event->image = $request->file('image')->store('events', 'public');
            Image::make('storage/'.$event->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $event->update();

        return $event;
    }
}
