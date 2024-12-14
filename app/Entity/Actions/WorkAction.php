<?php

namespace App\Entity\Actions;

use App\Entity\Actions\Traits\GetCity;
use App\Models\Work;

class WorkAction
{
    use GetCity;

    public function store($request, $user_id = null, $isActive = true): Work
    {
        $city = $this->getCity($request);

        $work = new Work();

        if ($isActive == false) {
            $work->activity = $isActive;
        }

        $work->name = $request->name;
        $work->address = $request->address;
        $work->description = $request->description;
        $work->city_id = $city->id;
        $work->region_id = $city->region->id;
        $work->type = $request->type;

        if ($request->parent == 'User') {
            $work->parent_type = 'App\Models\User';
            $work->parent_id = $request->user;
        } elseif ($request->parent == 'Company') {
            $work->parent_type = 'App\Models\Company';
            $work->parent_id = $request->company;
        } elseif ($request->parent == 'Group') {
            $work->parent_type = 'App\Models\Group';
            $work->parent_id = $request->group;
        } else {
            $work->parent_type = 'App\Models\User';
            $work->parent_id = 1;
        }

        $work->save();

        return $work;
    }

    public function update($request, $work): Work
    {
        $city = $this->getCity($request);

        $work->name = $request->name;
        $work->address = $request->address;
        $work->description = $request->description;
        $work->city_id = $city->id;
        $work->region_id = $city->region->id;
        // $work->type = $request->type;

        if ($request->parent == 'User') {
            $work->parent_type = 'App\Models\User';
            $work->parent_id = $request->user;
        } elseif ($request->parent == 'Company') {
            $work->parent_type = 'App\Models\Company';
            $work->parent_id = $request->company;
        } elseif ($request->parent == 'Group') {
            $work->parent_type = 'App\Models\Group';
            $work->parent_id = $request->group;
        } else {
            $work->parent_type = 'App\Models\User';
            $work->parent_id = 1;
        }

        $work->update();

        return $work;
    }
}
