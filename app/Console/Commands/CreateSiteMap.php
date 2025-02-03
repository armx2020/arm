<?php

namespace App\Console\Commands;

use App\Models\SiteMap;
use App\Services\SiteMapService;
use Illuminate\Console\Command;

class CreateSiteMap extends Command
{
    protected $signature = 'app:create-site-map {--truncate}';

    protected $description = 'создать карту сайта';

    public function handle(SiteMapService $siteMapService)
    {
        if($this->option('truncate')) {
            SiteMap::truncate();
        }

      //  $siteMapService->create();
        $siteMapService->addFile();
    }
}
