<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class YandexGeocoderService
{
    protected string $apiUrl;
    protected string $apiKey;
    protected int $dailyLimit = 2; // Дневной лимит
    protected int $usedRequests = 0;

    public function __construct()
    {
        $this->apiKey = config('services.yandex.geocoder_key');
        $this->usedRequests = Cache::get('yandex_geocoder_used_requests', 0);
    }

    public function geocode(string $address): ?array
    {
        if ($this->usedRequests >= $this->dailyLimit) {
            throw new \Exception('Daily limit exceeded');
        }

        try {
            $response = Http::retry(3, 100)->get($this->apiUrl, [
                'apikey' => $this->apiKey,
                'geocode' => $address,
                'format' => 'json',
                'results' => 1,
                'lang' => 'ru_RU'
            ]);

            $this->incrementRequestCount();

            if ($response->successful()) {
                return $this->parseResponse($response->json());
            }
        } catch (\Exception $e) {
            Log::error("Yandex Geocoder error: " . $e->getMessage());
        }

        return null;
    }

    protected function parseResponse(array $data): ?array
    {
        if (isset($data['response']['GeoObjectCollection']['featureMember'][0])) {
            $geoObject = $data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject'];
            $pos = $geoObject['Point']['pos'];

            list($lon, $lat) = explode(' ', $pos);

            return [
                'lat' => $lat,
                'lon' => $lon,
                'address' => $geoObject['metaDataProperty']['GeocoderMetaData']['text']
            ];
        }

        return null;
    }

    protected function incrementRequestCount(): void
    {
        $this->usedRequests++;
        Cache::put('yandex_geocoder_used_requests', $this->usedRequests, now()->addDay());
    }

    public function getRemainingRequests(): int
    {
        return $this->dailyLimit - $this->usedRequests;
    }

    public function hasAvailableRequests(): bool
    {
        return $this->usedRequests < $this->dailyLimit;
    }
}
