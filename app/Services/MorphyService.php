<?php

namespace App\Services;

use App\Services\ClientService;
use Illuminate\Database\Eloquent\Collection;

class MorphyService
{
    public $clientService;

    public function __construct(ClientService $clientService)
    {
        $this->clientService = $clientService;
    }

    public function setDative($region)
    {
        $region->chunk(50, function (Collection $regions) {

            foreach ($regions as $region) {
                
              $this->clientService->getItems($region->name);
                // $region->update([
                //     $region->name_date = ''
                // ]);
            }
        });
    }


}
