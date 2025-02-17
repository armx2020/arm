<?php

namespace App\Imports;

use App\Models\Category;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\PersistRelations;
use Maatwebsite\Excel\Concerns\WithUpserts;

class CategoryImport implements ToCollection, WithUpserts, PersistRelations
{
    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $category = Category::updateOrCreate(
                [
                    'name' => $row[1]
                ],
                [
                    'entity_type_id' => 1,
                    'category_id' => $this->getMainCategory($row[0]),
                    'activity' => 1,
                ]
            );
        }
    }

    public function uniqueBy()
    {
        return 'name';
    }

    public function getMainCategory($data)
    {
        $category_main = Category::updateOrCreate(
            [
                'name' => $data
            ],
            [
                'entity_type_id' => 1,
                'category_id' => 19,
                'activity' => 1,
            ]
        );

        return $category_main->id;
    }
}
