<?php

namespace App\Entity\Actions;

use App\Entity\Actions\Traits\GetCity;
use App\Models\Work;

class ResumeAction
{
    use GetCity;

    public function store($request): Work
    {
        $city = $this->getCity($request);

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
        $city = $this->getCity($request);

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