<?php

namespace App\Console\Commands;

use App\Models\City;
use Illuminate\Console\Command;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Http;
use Exception;

class UpdateCitiesCoordinates extends Command
{
    protected $signature = 'cities:update-coordinates';

    protected $description = 'Обновление геогрофических координат с помощью Yandex Geocoder API';

    protected $apiUrl = 'https://geocode-maps.yandex.ru/1.x/';

    protected $apiKey;

    public function __construct()
    {
        parent::__construct();
        $this->apiKey = config('services.yandex.geocoder_key');
    }

    public function handle()
    {
        $totalCities = City::count();

        $this->info("Starting to update coordinates for {$totalCities} cities...");

        $progressBar = $this->output->createProgressBar($totalCities);
        $progressBar->start();

        City::chunk(50, function (Collection $cities) use ($progressBar) {
            foreach ($cities as $city) {

                if ($city->id == 1) {
                    continue;
                }


                try {
                    $coordinates = $this->getCoordinates($city->name_ru);

                    if ($coordinates) {
                        $city->update([
                            'lat' => $coordinates['lat'],
                            'lon' => $coordinates['lon']
                        ]);
                    } else {
                        $this->error("Failed to get coordinates for city: {$city->name_ru}");
                    }
                } catch (Exception $e) {
                    $this->error("Error processing city ID {$city->id}: " . $e->getMessage());
                }

                $progressBar->advance();

                // Пауза чтобы не превысить лимиты API
                usleep(500000); // 0.5 секунды
            }
        });

        $progressBar->finish();
        $this->newLine(2);

        $this->info("Update completed!");
    }

    protected function getCoordinates(string $cityName): ?array
    {
        $response = Http::get($this->apiUrl, [
            'apikey' => $this->apiKey,
            'geocode' => $cityName,
            'format' => 'json',
            'results' => 1,
            'lang' => 'ru_RU',
            'kind' => 'locality' // Ищем именно города
        ]);

        if ($response->successful()) {
            $data = $response->json();

            if (isset($data['response']['GeoObjectCollection']['featureMember'][0])) {
                $geoObject = $data['response']['GeoObjectCollection']['featureMember'][0]['GeoObject'];
                $pos = $geoObject['Point']['pos'];

                list($lon, $lat) = explode(' ', $pos);

                return [
                    'lat' => $lat,
                    'lon' => $lon
                ];
            }
        }

        return null;
    }
}
