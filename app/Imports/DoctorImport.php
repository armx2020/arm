<?php

namespace App\Imports;

use App\Models\City;
use App\Models\Entity;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\PersistRelations;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class DoctorImport implements ToCollection, WithUpserts, PersistRelations, WithStartRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $entity = Entity::updateOrCreate(
                [
                    'name' => $row[2]
                ],
                [
                    'link' => $row[1],
                    'phone' => $row[3],
                    'comment' => $row[4],
                    'description' => $row[6],
                    'clinic' => $row[7],
                    'address' => mb_substr($row[8], 0, 128),
                    'city_id' => $this->getCityName($row[9]),
                    'region_id' => $this->getRegionName($row[9]),
                    'activity' => false,
                    'entity_type_id' => 1,
                    'category_id' => 19,
                ]
            );

            $entity->fields()->syncWithPivotValues([29], ['main_category_id' => 19]);

            $entity->images()->withOutGlobalScopes()->delete();

            if (Storage::disk('public')->exists("uploaded/doctor/$row[0]/$row[0].png")) {
                $entity->images()->create([
                    'path' => "uploaded/doctor/$row[0]/$row[0].png"
                ]);
            }
        }
    }

    public function startRow(): int
    {
        return 2;
    }

    public function uniqueBy()
    {
        return 'name';
    }

    public function getCityName($data)
    {
        $city = 1;

        $cityBD = City::where('name', 'LIKE', "%$data%")->First();

        if ($cityBD) {
            $city = $cityBD->id;
        }

        return $city;
    }

    public function getRegionName($data)
    {
        $region = 1;


        $cityBD = City::where('name', 'LIKE', "%$data%")->First();

        if ($cityBD) {
            $region = $cityBD->region_id;
        }

        return $region;
    }
}
