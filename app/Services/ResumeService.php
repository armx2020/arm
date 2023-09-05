<?php

namespace App\Services;

use App\Models\City;
use App\Models\Resume;

class ResumeService
{
    public function store($request): Resume
    {
        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $resume = new Resume();

        $resume->name = $request->name;
        $resume->address = $request->address;
        $resume->description = $request->description;
        $resume->city_id = $request->city;
        $resume->region_id = $city->region->id;
        $resume->price = $request->price;
        $resume->user_id = $request->user;

        $resume->save();

        return $resume;
    }

    public function update($request, $resume): Resume
    {
        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $resume->name = $request->name;
        $resume->address = $request->address;
        $resume->description = $request->description;
        $resume->city_id = $request->city;
        $resume->region_id = $city->region->id;
        $resume->price = $request->price;
        $resume->user_id = $request->user;

        $resume->update();

        return $resume;
    }
}
