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
        $work->entity_id = $request->entity;

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
        $work->entity_id = $request->entity;

        $work->update();

        return $work;
    }
}
