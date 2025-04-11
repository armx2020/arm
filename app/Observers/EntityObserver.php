<?php

namespace App\Observers;

use App\Jobs\ProcessEntitiesGeocoding;
use App\Models\Entity;
use App\Services\YandexGeocoderService;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EntityObserver
{
    public function __construct(public YandexGeocoderService $service)
    {
        //
    }

    public function saving(Entity $entity)
    {
        if ($entity->address && $entity->city_id) {
            if (!$this->service->hasAvailableRequests()) {
                ProcessEntitiesGeocoding::dispatch($entity)->onQueue('geocoding');
            }

            $coordinates = $this->service->geocode($entity->city->name, ', ', $entity->address);

            if ($coordinates) {
                $entity->update([
                    'lat' => $coordinates['lat'],
                    'lon' => $coordinates['lon']
                ]);
            }
        }
    }
}
