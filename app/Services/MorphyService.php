<?php

namespace App\Services;

use Illuminate\Database\Eloquent\Collection;

class MorphyService
{
    public static function setDative($region)
    {
        $region->chunk(50, function (Collection $regions) {

            foreach ($regions as $region) {
                
                // $region->update([
                //     $region->name_date = ''
                // ]);
            }
        });
    }
}
