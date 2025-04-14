<?php

namespace App\Observers;

use App\Models\Entity;
use App\Services\YandexGeocoderService;
use Illuminate\Support\Facades\Log;

class EntityObserver
{
    public function __construct(protected YandexGeocoderService $service)
    {
        //
    }

    public function saving(Entity $entity)
    {
        if (!$entity->isDirty('address')) {
            return;
        }

        if ($entity->address && $entity->city_id) {
            $coordinates = $this->service->geocode($entity);

            if ($coordinates) {
                $entity->lat = $coordinates['lat'];
                $entity->lon = $coordinates['lon'];
            } else {
                Log::info('EntityObserver:  No coordinates for entity', ['entityID' => $entity->id]);
            }
        }

        return;
    }
}
