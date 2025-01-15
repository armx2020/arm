<?php

namespace App\Imports;

use App\Models\City;
use Maatwebsite\Excel\Concerns\ToModel;
use App\Models\Entity;
use Maatwebsite\Excel\Concerns\PersistRelations;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class ChurchImport implements ToModel, WithUpserts, PersistRelations, WithStartRow
{
    public function model(array $row)
    {
        return new Entity([
            'name' => $row[2],
            'city_id' => $this->getCityName($row[3]),
            'address' => $row[4],
            'phone' => preg_replace('/[^0-9]/', '', $row[5]),
            'web' => $row[6],
            'vkontakte' => $row[7],
            'whatsapp' => $row[8],
            'telegram' => $row[9],
            'activity' => true,
            'region_id' => $this->getRegionName($row[3]),
            'entity_type_id' => 3,
            'category_id' => 6,
            'image' => "uploaded/church/$row[0]/$row[0]_1.jpg"
        ]);

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
        $city = City::where('name', '%LIKE%', $data)->First();

        return $city ? $city->id : 1;
    }

    public function getRegionName($data)
    {
        $city = City::where('name', '%LIKE%', $data)->First();

        return $city ? $city->region->id : 1;
    }
}
