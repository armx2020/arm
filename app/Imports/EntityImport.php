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

class EntityImport implements ToCollection, WithUpserts, PersistRelations, WithStartRow
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $entity = Entity::updateOrCreate(
                [
                    'name' => $row[5]
                ],
                [
                    'link' => $row[1],
                    'comment' => $row[2],
                    'entity_type_id' => $row[3],
                    'category_id' => $row[4],
                    'description' => $row[6],
                //    'started_at' => $row[7],
                    'director' => $row[8],
                    'phone' =>  preg_replace('/[^0-9]/', '', mb_substr($row[9], 0, 36)),
                    'email' => mb_substr($row[10], 0, 96),
                    'address' => mb_substr($row[12], 0, 128),
                  // 'web' => $row[11],
                    'image' => null,
                    'activity' => false,
                ]
            );

            if (Storage::disk('public')->exists("uploaded/entity/$row[0]/$row[0]_1.jpg")) {
                $entity->image = "uploaded/entity/$row[0]/$row[0]_1.jpg";
                $entity->update();
            }

            $entity->images()->delete();

            if (Storage::disk('public')->exists("uploaded/entity/$row[0]/$row[0]_2.jpg")) {
                $entity->images()->create([
                    'path' => "uploaded/entity/$row[0]/$row[0]_2.jpg"
                ]);
            }

            if (Storage::disk('public')->exists("uploaded/entity/$row[0]/$row[0]_3.jpg")) {
                $entity->images()->create([
                    'path' => "uploaded/entity/$row[0]/$row[0]_3.jpg"
                ]);
            }

            if (Storage::disk('public')->exists("uploaded/entity/$row[0]/$row[0]_4.jpg")) {
                $entity->images()->create([
                    'path' => "uploaded/entity/$row[0]/$row[0]_4.jpg"
                ]);
            }

            if (Storage::disk('public')->exists("uploaded/entity/$row[0]/$row[0]_5.jpg")) {
                $entity->images()->create([
                    'path' => "uploaded/entity/$row[0]/$row[0]_5.jpg"
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
        $city = City::where('name', 'LIKE', "%$data%")->First();

        return $city ? $city->id : 1;
    }

    public function getRegionName($data)
    {
        $city = City::where('name', 'LIKE', "%$data%")->First();

        return $city ? $city->region->id : 1;
    }
}
