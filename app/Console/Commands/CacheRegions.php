<?php

namespace App\Console\Commands;

use App\Models\Region;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CacheRegions extends Command
{
    protected $signature = 'cache-regions';
    protected $description = 'Сохранение регионов в алфавитном порядке в кэш';

    public function handle()
    {
        $regions = Region::whereNot('code', 0)->get()->sortBy('name')
            ->groupBy(function ($item) {
                return mb_substr($item->name, 0, 1);
            });

        Cache::put('regions', $regions, now()->addHours(24));

        $this->info('Regions data saved successfully.');
    }
}
