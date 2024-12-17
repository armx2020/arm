<?php

namespace App\Services;

use App\Models\Entity;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class ImportService
{
    public function setDataFromEntity($oldEntity)
    {
        $oldEntity->chunk(100, function (Collection $oldEntities) {
            foreach ($oldEntities as $entity) {

                $newEntity = Entity::firstOrCreate([
                    'name' => $entity->name,
                    'activity' => $entity->activity,
                    'type' => $this->getType($entity->getTable()),
                    'address' => $entity->address,
                    'image' => $this->getNewPathForImage($entity->image),
                    'description' => $entity->description,
                    'phone' => $entity->phone,
                    'web' => $entity->web,
                    'whatsapp' => $entity->whatsapp,
                    'instagram' => $entity->instagram,
                    'vkontakte' => $entity->vkontakte,
                    'telegram' => $entity->telegram,
                    'user_id' => $entity->user_id,
                    'city_id' => $entity->city_id,
                    'region_id' => $entity->region_id,
                    'category_id' => $entity->category_id
                ]);

                if ($entity->getTable() == 'companies') {
                    $this->syncFields($entity, $newEntity);
                }
            }
        });
    }

    public function getType($table)
    {
        switch ($table) {
            case 'companies':
                return 'company';
                break;
            case 'groups':
                return 'group';
                break;
            default:
                return null;
                break;
        }
    }

    public function syncFields($fromEntity, $toEntity)
    {
        foreach ($fromEntity->categories as $category) {
            $toEntity->fields()->attach($category->id, ['main_category_id' => $category->pivot->main_category_id]);
        }
    }

    public function getNewPathForImage($imageURL)
    {
        $imageName = null;

        $imageFullUrl = explode("/", $imageURL);

        if (isset($imageFullUrl[1])) {
            $imageName = $imageFullUrl[1];
            Storage::move('public/' . $imageURL, 'public/entities/' . $imageFullUrl[1]);
            $imageName = 'storage/' . $imageFullUrl[1];
        }

        return $imageName;
    }
}
