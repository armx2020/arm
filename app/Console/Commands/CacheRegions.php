<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Region;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheRegions extends Command
{
    protected $signature = 'cache-regions';
    protected $description = 'Сохранение регионов и городв в кэш';

    public function handle()
    {
        $regionsSortByName = Region::whereNot('code', 0)->get()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        $all_regions = Region::get();
        $all_cities = City::get();

        Cache::put('regions', $regionsSortByName); // Для меню
        Cache::put('all_regions', $all_regions);
        Cache::put('all_cities', $all_cities);

        $this->info('Regions and cities data saved successfully.');
    }
}
