<?php

namespace App\Observers;

use App\Models\Entity;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class EntityObserver
{
    public function saving(Entity $entity)
    {
        if (!$entity->coordinates && $entity->address && $entity->city_id) {
            $this->geocode($entity);
        }
    }

    protected function geocode(Entity $entity)
    {
        try {
            $apiKey = config('services.yandex.geocoder_key');

            if (empty($apiKey)) {
                throw new \Exception('Yandex Geocoder API key is missing in .env');
            }

            $response = Http::get('https://geocode-maps.yandex.ru/1.x/', [
                'apikey' => $apiKey,
                'geocode' => $entity->city->name . ', ' . $entity->address,
                'format' => 'json',
            ]);

            $data = $response->json();

            if (isset($data['response']['GeoObjectCollection']['featureMember'][0])) {
                $coords = explode(
                    ' ',
                    $data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject']['Point']['pos']
                );
                $entity->lon = $coords[0]; // Долгота
                $entity->lat = $coords[1]; // Широта

            } else {
                Log::warning("No geocoding results for Entity ID: {$entity->id}", [
                    'city' => $entity->city->name,
                    'address' => $entity->address,
                    'full_response' => $data
                ]);
            }
        } catch (\Exception $e) {
            Log::error("Geocoding failed for Entity ID: {$entity->id}", ['error' => $e->getMessage()]);
        }
    }
}
