<?php

namespace App\Observers;

use App\Jobs\ProcessEntitiesGeocoding;
use App\Models\Entity;
use App\Services\YandexGeocoderService;


class EntityObserver
{
    public function __construct(public YandexGeocoderService $service)
    {
        //
    }

    public function saving(Entity $entity)
    {
        if ($entity->address && $entity->city_id) {
            if ($this->service->hasAvailableRequests()) {
                $coordinates = $this->service->geocode($entity->city->name, ', ', $entity->address);

                if ($coordinates) {
                    $entity->update([
                        'lat' => $coordinates['lat'],
                        'lon' => $coordinates['lon']
                    ]);
                }
            } else {
                ProcessEntitiesGeocoding::dispatch($entity)->onQueue('geocoding');
            }
        }
    }
}
