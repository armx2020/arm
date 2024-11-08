<?php

namespace App\Services;

use App\Models\City;
use App\Models\Vacancy;

class VacancyService
{
    public function store($request): Vacancy
    {
        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $vacancy = new Vacancy();

        $vacancy->name = $request->name;
        $vacancy->address = $request->address;
        $vacancy->description = $request->description;
        $vacancy->price = $request->price;
        $vacancy->city_id = $request->city;
        $vacancy->region_id = $city->region->id;

        if ($request->parent == 'User') {
            $vacancy->parent_type = 'App\Models\User';
            $vacancy->parent_id = $request->user;
        } elseif ($request->parent == 'Company') {
            $vacancy->parent_type = 'App\Models\Company';
            $vacancy->parent_id = $request->company;
        } elseif ($request->parent == 'Group') {
            $vacancy->parent_type = 'App\Models\Group';
            $vacancy->parent_id = $request->group;
        } else {
            $vacancy->parent_type = 'App\Models\Admin';
            $vacancy->parent_id = 1;
        }

        $vacancy->save();

        return $vacancy;
    }

    public function update($request, $vacancy): Vacancy
    {
        $city = City::with('region')->find($request->city);

        if (empty($city)) {
            $city = City::find(1);
        }

        $vacancy->name = $request->name;
        $vacancy->address = $request->address;
        $vacancy->description = $request->description;
        $vacancy->price = $request->price;
        $vacancy->city_id = $request->city;
        $vacancy->region_id = $city->region->id;

        if ($request->parent == 'User') {
            $vacancy->parent_type = 'App\Models\User';
            $vacancy->parent_id = $request->user;
        } elseif ($request->parent == 'Company') {
            $vacancy->parent_type = 'App\Models\Company';
            $vacancy->parent_id = $request->company;
        } elseif ($request->parent == 'Group') {
            $vacancy->parent_type = 'App\Models\Group';
            $vacancy->parent_id = $request->group;
        } else {
            $vacancy->parent_type = 'App\Models\Admin';
            $vacancy->parent_id = 1;
        }

        $vacancy->update();

        return $vacancy;
    }
}
