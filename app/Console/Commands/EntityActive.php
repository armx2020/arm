<?php

namespace App\Console\Commands;

use App\Models\Entity;
use Illuminate\Console\Command;

class UpdateEntityCoordinates extends Command
{
    protected $signature = 'entities:avtive';

    protected $description = 'Включение сущностей';


    public function handle()
    {
        Entity::chunk(500, function ($entities) {
            foreach ($entities as $entity) {
                $entity->activity = true;
                $entity->save();
            }
        });
    }
}
