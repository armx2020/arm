<?php

namespace App\Console\Commands;

use App\Models\Entity;
use App\Services\TranscriptService;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Collection;

class TransferImageFromEntity extends Command
{
    protected $signature = 'app:transfer-image';

    protected $description = 'перенос изображений с image(колонка в сущности) в images таблицу';

    public function handle(TranscriptService $service)
    {
        Entity::chunk(100, function(Collection $collections) {
            foreach ($collections as $collection) {
                dd($collection->images()->get());
                if($collection->image) {
                    $collection->images()->create([
                        'path' => $collection->image,
                        'activity' => 1,
                        'checked' => 1,
                        'sort_id' => 0,
                        'created_at' => '2023-01-21 10:51:30',
                        'updated_at' => '2023-01-21 10:51:30',
                    ]);
                }
            };
        });
    }
}
