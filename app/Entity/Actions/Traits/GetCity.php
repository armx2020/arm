<?php

namespace App\Entity\Actions\Traits;

use App\Models\City;

trait GetCity
{
    public function getCity($request): City
    {
        $city = City::with('region')->find($request->select_city);

        if (empty($city)) {
            $city = City::find(1);
        }

        return $city;
    }
}
