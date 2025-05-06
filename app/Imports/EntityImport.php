<?php

namespace App\Imports;

use App\Models\City;
use App\Models\Entity;
use DateTime;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\PersistRelations;
use Maatwebsite\Excel\Concerns\WithStartRow;
use Maatwebsite\Excel\Concerns\WithUpserts;

class EntityImport implements ToCollection, WithUpserts, PersistRelations, WithStartRow
{
    public $whatsapp = null;
    public $telegram = null;
    public $web = null;
    public $instagram = null;
    public $vkontakte = null;

    public function collection(Collection $rows)
    {
        foreach ($rows as $row) {

            $this->parseWeb($row[11]);

            $entity = Entity::updateOrCreate(
                [
                    'name' => $row[5]
                ],
                [
                    // 'link' => $row[1],
                    // 'comment' => $row[2],
                    // 'entity_type_id' => $row[3],
                    // 'category_id' => $row[4],
                    // 'description' => $row[6],
                    // 'started_at' => $this->getStartedDate($row[7]),
                    // 'director' => $row[8],
                    // 'phone' => $this->getPhone($row[9]),
                    // 'email' => $this->getEmail($row[10]),
                    // 'address' => mb_substr($row[12], 0, 128),
                    // 'web' => $this->web,
                    // 'whatsapp' => $this->whatsapp,
                    // 'instagram' => $this->instagram,
                    // 'vkontakte' => $this->vkontakte,
                    // 'telegram' => $this->telegram,
                    // 'city_id' => $this->getCityName($row[12]),
                    // 'region_id' => $this->getRegionName($row[12]),
                    'image' => null,
                    // 'activity' => false,
                ]
            );

            $entity->images()->withOutGlobalScopes()->delete();

            if (Storage::disk('public')->exists("uploaded/entity/$row[0]/1.jpg")) {
                $entity->images()->create([
                    'path' => "uploaded/entity/$row[0]/1.jpg"
                ]);
            }

            if (Storage::disk('public')->exists("uploaded/entity/$row[0]/2.jpg")) {
                $entity->images()->create([
                    'path' => "uploaded/entity/$row[0]/2.jpg"
                ]);
            }

            if (Storage::disk('public')->exists("uploaded/entity/$row[0]/3.jpg")) {
                $entity->images()->create([
                    'path' => "uploaded/entity/$row[0]/3.jpg"
                ]);
            }

            if (Storage::disk('public')->exists("uploaded/entity/$row[0]/4.jpg")) {
                $entity->images()->create([
                    'path' => "uploaded/entity/$row[0]/4.jpg"
                ]);
            }

            if (Storage::disk('public')->exists("uploaded/entity/$row[0]/5.jpg")) {
                $entity->images()->create([
                    'path' => "uploaded/entity/$row[0]/5.jpg"
                ]);
            }

            // $this->resetWeb();
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
        preg_match_all('/(г|город|Город|Г|г\.|Г\.|г\sо|г\sп)\s(\w+)\b/iu', $data, $matches);

        $city = 1;

        if (isset(($matches[2][0]))) {

            $searchString = (string)$matches[2][0];

            $cityBD = City::where('name', 'LIKE', "%$searchString%")->First();

            if ($cityBD) {
                $city = $cityBD->id;
            }
        }

        return $city;
    }

    public function getRegionName($data)
    {
        preg_match_all('/(г|город|Город|Г|г\.|Г\.)\s(\w+)\b/iu', $data, $matches);

        $region = 1;

        if (isset(($matches[2][0]))) {
            $searchString = (string)$matches[2][0];

            $cityBD = City::where('name', 'LIKE', "%$searchString%")->First();

            if ($cityBD) {
                $region = $cityBD->region_id;
            }
        }

        return $region;
    }

    public function getEmail($data)
    {
        preg_match_all('/([a-z0-9_\-]+\.)*[a-z0-9_\-]+@([a-z0-9][a-z0-9\-]*[a-z0-9]\.)+[a-z]{2,6}/i', $data, $matches);

        $email = null;

        if ($matches[0] !== []) {
            $email = $matches[0][0];
        }

        return $email;
    }

    public function getPhone($data)
    {
        preg_match_all("/^(8|\+7|7)[\- ]\([0-9]{3}\)[\- ]?[0-9]{3}[\- ]?[0-9]{2}[\- ]?[0-9]{2}[\- ]?/", $data, $matches);

        $phone = null;

        if (isset(($matches[0][0]))) {
            $phone = $matches[0][0];
        }
        return $phone;
    }

    public function parseWeb($data)
    {
        $url = parse_url($data);

        if (isset($url['host'])) {
            switch ($url['host']) {
                case 'vk.com':
                    $this->vkontakte = $data;
                    break;
                case 't.me':
                    $this->telegram = $data;
                    break;
                case 'instagram.com':
                    $this->instagram = $data;
                    break;
                case 'wa.me':
                    $this->whatsapp = $data;
                    break;
                default:
                    $this->web = $data;
                    break;
            }
        } else {
            $this->web = $data;
        }
    }

    public function resetWeb()
    {
        $this->whatsapp = null;
        $this->telegram = null;
        $this->web = null;
        $this->instagram = null;
        $this->vkontakte = null;
    }

    public function getStartedDate($date)
    {
        $startedDate = null;

        preg_match_all('/^[0-9]{2}\.[0-9]{2}\.[1-2](0|9)(0|8|9)[0-9]{1}/', $date, $matches);

        if (isset(($matches[0][0]))) {
            $startedDate = $matches[0][0];
        }

        return $startedDate;
    }
}
