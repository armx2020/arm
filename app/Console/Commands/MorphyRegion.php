<?php

namespace App\Console\Commands;

use App\Models\City;
use App\Models\Region;
use App\Services\MorphyService;
use Illuminate\Console\Command;

class MorphyRegion extends Command
{
    protected $signature = 'app:morphy-region { --dative}';

    protected $description = 'Добавление дательного падежа к региону';

    public function handle(MorphyService $morphyService)
    {
        $regions = Region::query();
        $cities = City::query();

        if ($this->option('dative')) {
            $morphyService->setDative($regions);
           // $morphyService->setDative($cities);
        }
    }
}
