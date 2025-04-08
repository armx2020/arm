<?php

namespace App\Observers;

use App\Models\Entity;
use Illuminate\Support\Facades\Http;

class EntityObserver
{
    public function saving(Entity $entity)
    {
        if ($entity->isDirty('address') && !$entity->coordinates && $entity->address && $entity->city_id) {
            $this->geocode($entity);
        }
    }

    protected function geocode(Entity $entity)
    {
        $response = Http::get('https://geocode-maps.yandex.ru/1.x/', [
            'apikey' => env('YANDEX_GEOCODER_KEY'),
            'geocode' => $entity->city->name . ', ' .$entity->address,
            'format' => 'json',
        ]);

        $data = $response->json();

        if (isset($data['response']['GeoObjectCollection']['featureMember'][0])) {
            $coords = explode(' ', 
                $data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos']
            );
            $entity->lon = $coords[0]; // Долгота
            $entity->lat = $coords[1]; // Широта
        }
    }
}
