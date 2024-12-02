<?php

namespace App\Entity\Actions;

use App\Models\Event;
use App\Entity\Actions\Traits\GetCity;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;
// TODO переместить сервисы сущностей в актион
class EventService
{
    use GetCity;

    public function store($request): Event
    {
        $city = $this->getCity($request);

        $event = new Event();

        $event->name = $request->name;
        $event->address = $request->address;
        $event->description = $request->description;
        $event->city_id = $city->id;
        $event->region_id = $city->region->id;
        $event->date_to_start = $request->date_to_start;
        $event->category_id = $request->category;

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
            $event->parent_type = 'App\Models\User';
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
        $city = $this->getCity($request);

        $event->name = $request->name;
        $event->address = $request->address;
        $event->description = $request->description;
        $event->city_id = $request->city;
        $event->region_id = $city->region->id;
        $event->date_to_start = $request->date_to_start;
        $event->category_id = $request->category;

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
            $event->parent_type = 'App\Models\User';
            $event->parent_id = 1;
        }

        if ($request->image_remove == 'delete') {
            Storage::delete('public/' . $event->image);
            $event->image = null;
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
