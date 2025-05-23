<?php

namespace App\Imports;

use App\Models\Category;
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
    public $comment = '';

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            //$mainCategory = $this->getCategory($row[4]);

            $entity = Entity::updateOrCreate(
                [
                    'name' => $row[2]
                ],
                [
                    // 'link' => $row[1],
                    // 'phone' => $row[3],
                    // 'comment' => $this->comment,
                    // 'description' => $this->parseDescription($row[6]),
                    // 'clinic' => $row[7],
                    // 'address' => mb_substr($row[8], 0, 128),
                    // 'city_id' => $this->getCityName($row[9]),
                    // 'region_id' => $this->getRegionName($row[9]),
                    // 'activity' => false,
                    // 'entity_type_id' => 1,
                    // 'category_id' => 19,
                ]
            );

            //$entity->fields()->syncWithPivotValues([$mainCategory->category_id ?: $mainCategory->id], ['main_category_id' => 19]);

            //$this->comment = '';

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

    public function parseDescription($data)
    {
        $withoutTheLastLetters = mb_substr($data, 0, -40);

        $position = strpos($withoutTheLastLetters, ". ");

        $beforeSpace = substr($withoutTheLastLetters, 0, $position);
        $afterSpace = substr($withoutTheLastLetters, $position + 2);

        $withEnter = "$beforeSpace. \n$afterSpace";

        return $withEnter;
    }

    public function getCategory($data)
    {
        if (mb_strstr($data, ', ', true)) {
            $data = mb_strstr($data, ', ', true);
        }

        $category = Category::with('parent')->where('name', 'LIKE', "%$data%")->First();

        if (!$category) {
            $category = Category::with('parent')->where('name', 'LIKE', 'Терапевт')->First();

            if ($this->comment == '') {
                $this->comment = "Не найденные строки: " .  $data . "; ";
            } else {
                $this->comment = $this->comment .  $data . "; ";
            }
        }

        return $category;
    }
}
