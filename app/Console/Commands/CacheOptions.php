<?php

namespace App\Console\Commands;

use App\Models\Option;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class CacheOptions extends Command
{
    protected $signature = 'cache-options';
    protected $description = 'Сохранение опций в кэш';

    public function handle()
    {
        Log::info('option-cache');
        // $options = Option::select('name_ru', 'name_en', 'value')->get();

        // if ($options->isEmpty()) {
        //     Option::create(
        //         ['name_ru' => 'активный api-id для смс.ру', 'name_en' => 'api_id_active', 'value' => 'отсутствет']
        //     );

        //     Option::create(
        //         ['name_ru' => 'тестовый api-id для смс.ру', 'name_en' => 'api_id_deactive', 'value' => 'отсутствет']
        //     );

        //     $options = Option::select('name_ru', 'name_en', 'value')->get();
        // }

        // Cache::put('options', $options);

        // $this->info('Optons data saved successfully.');
    }
}
