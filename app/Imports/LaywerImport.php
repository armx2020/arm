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

class LaywerImport implements ToCollection, WithUpserts, PersistRelations, WithStartRow
{

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {
            $entity = Entity::updateOrCreate(
                [
                    'name' => $row[2]
                ],
                [
                    'link' => $row[1] == '_' ? null : $row[1],
                    'description' => $row[3] == '_' ? null : $row[3],
                    'city_id' => $this->getCityName($row[4] == '_' ? null : $row[4]),
                    'region_id' => $this->getRegionName($row[4] == '_' ? null : $row[4]),
                    'address' => $this->getAddress($row[5]),
                    'phone' => $row[6] == '_' ? null : $row[6],
                    'whatsapp' => $row[7] == '_' ? null : $row[7],
                    'email' =>  $row[8] == '_' ? null : $row[8],
                    'web' => $row[9] == '_' ? null : $row[9],
                    'telegram' => $row[10] == '_' ? null : $row[10],
                    'vkontakte' => $row[11] == '_' ? null : $row[11],

                    'comment' => $this->getComment([$row[12], $row[13], $row[14], $row[15], $row[16], $row[17], $row[18], $row[18]]),
                    'entity_type_id' => 1,
                    'category_id' => 78,

                    'image' => null,
                    // 'activity' => false,
                ]
            );

            $entity->fields()->syncWithPivotValues([86, 87, 88, 91], ['main_category_id' => 78]);


            if (Storage::disk('public')->exists("uploaded/lawyer/$row[0]/1.png")) {
                $entity->image = "uploaded/lawyer/$row[0]/1.png";
                $entity->update();
            }

            $entity->images()->delete();

            if (Storage::disk('public')->exists("uploaded/lawyer/$row[0]/2.png")) {
                $entity->images()->create([
                    'path' => "uploaded/lawyer/$row[0]/2.png"
                ]);
            }

            if (Storage::disk('public')->exists("uploaded/lawyer/$row[0]/3.png")) {
                $entity->images()->create([
                    'path' => "uploaded/lawyer/$row[0]/3.png"
                ]);
            }

            if (Storage::disk('public')->exists("uploaded/lawyer/$row[0]/4.png")) {
                $entity->images()->create([
                    'path' => "uploaded/lawyer/$row[0]/4.png"
                ]);
            }

            if (Storage::disk('public')->exists("uploaded/lawyer/$row[0]/5.png")) {
                $entity->images()->create([
                    'path' => "uploaded/lawyer/$row[0]/5.png"
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

    public function getComment($data = [])
    {
        $comment = null;

        foreach ($data as $row) {
            if (isset($row)) {
                $comment = $comment . $row . '; ';
            }
        }

        return $comment;
    }

    public function getAddress($data)
    {
        $address = null;

        if ($data && $data !== '_') {
            $address = mb_substr($data, 0, 128);
        }

        return $address;
    }
}
