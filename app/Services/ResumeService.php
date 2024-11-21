<?php

namespace App\Services;

use App\Models\City;
use App\Models\Work;

class ResumeService
{
    public function store($request): Work
    {
        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $resume = new Work();

        $resume->name = $request->name;
        $resume->address = $request->address;
        $resume->description = $request->description;
        $resume->city_id = $city->id;
        $resume->region_id = $city->region->id;
        $resume->parent_type = 'App\Models\User';
        $resume->parent_id = $request->user;
        $resume->type = 'resume';

        $resume->save();

        return $resume;
    }

    public function update($request, $resume): Work
    {
        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $resume->name = $request->name;
        $resume->address = $request->address;
        $resume->description = $request->description;
        $resume->city_id = $city->id;
        $resume->region_id = $city->region->id;
        $resume->parent_type = 'App\Models\User';
        $resume->parent_id = $request->user;
        $resume->type = 'resume';

        $resume->update();

        return $resume;
    }
}