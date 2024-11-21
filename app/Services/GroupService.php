<?php

namespace App\Services;

use App\Models\City;
use App\Models\Group;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image as Image;

class GroupService
{
    public function store($request): Group
    {
        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $group = new Group();

        $group->name = $request->name;
        $group->address = $request->address;
        $group->description = $request->description;
        $group->city_id = $city->id;
        $group->region_id = $city->region->id;
        $group->phone = $request->phone;
        $group->web = $request->web;
        $group->viber = $request->viber;
        $group->whatsapp = $request->whatsapp;
        $group->telegram = $request->telegram;
        $group->instagram = $request->instagram;
        $group->vkontakte = $request->vkontakte;
        $group->user_id = $request->user;
        $group->category_id = $request->category;
     
        if ($request->image) {
            $group->image = $request->file('image')->store('groups', 'public');
            Image::make('storage/'.$group->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image1) {
            $group->image1 = $request->file('image1')->store('groups', 'public');
            Image::make('storage/'.$group->image1)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image2) {
            $group->image2 = $request->file('image2')->store('groups', 'public');
            Image::make('storage/'.$group->image2)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image3) {
            $group->image3 = $request->file('image3')->store('groups', 'public');
            Image::make('storage/'.$group->image3)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }
        if ($request->image4) {
            $group->image4 = $request->file('image4')->store('groups', 'public');
            Image::make('storage/'.$group->image4)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $group->save();

        return $group;
    }

    public function update($request, $group): Group
    {
        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        if ($request->image_r == 'delete') {
            Storage::delete('public/' . $group->image);
            $group->image = null;            
        }

        if ($request->image_r1 == 'delete') {
            Storage::delete('public/' . $group->image1);
            $group->image1 = null;            
        }

        if ($request->image_r2 == 'delete') {
            Storage::delete('public/' . $group->image2);
            $group->image2 = null;            
        }

        if ($request->image_r3 == 'delete') {
            Storage::delete('public/' . $group->image3);
            $group->image3 = null;            
        }

        if ($request->image_r4 == 'delete') {
            Storage::delete('public/' . $group->image4);
            $group->image4 = null;            
        }

        if ($request->image) {
            Storage::delete('public/' . $group->image);            
            $group->image = $request->file('image')->store('groups', 'public');
            Image::make('storage/'.$group->image)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image1) {
            Storage::delete('public/' . $group->image1);
            $group->image1 = $request->file('image1')->store('groups', 'public');
            Image::make('storage/'.$group->image1)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image2) {
            Storage::delete('public/' . $group->image2);
            $group->image2 = $request->file('image2')->store('groups', 'public');
            Image::make('storage/'.$group->image2)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image3) {
            Storage::delete('public/' . $group->image3);
            $group->image3 = $request->file('image3')->store('groups', 'public');
            Image::make('storage/'.$group->image3)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        if ($request->image4) {
            Storage::delete('public/' . $group->image4);
            $group->image4 = $request->file('image4')->store('groups', 'public');
            Image::make('storage/'.$group->image4)->resize(400, null, function ($constraint) {
                $constraint->aspectRatio();
            })->save();
        }

        $group->name = $request->name;
        $group->address = $request->address;
        $group->description = $request->description;
        $group->city_id = $request->city;
        $group->region_id = $city->region->id;
        $group->phone = $request->phone;
        $group->web = $request->web;
        $group->viber = $request->viber;
        $group->whatsapp = $request->whatsapp;
        $group->telegram = $request->telegram;
        $group->instagram = $request->instagram;
        $group->vkontakte = $request->vkontakte;
        $group->user_id = $request->user;
        $group->category_id = $request->category;

        $group->update();

        return $group;
    }
}
