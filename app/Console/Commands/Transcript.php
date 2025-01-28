<?php

namespace App\Console\Commands;

use App\Models\Category;
use App\Models\EntityType;
use App\Services\TranscriptService;
use Illuminate\Console\Command;

class Transcript extends Command
{
    protected $signature = 'app:transcript';

    protected $description = 'translit table';

    public function handle(TranscriptService $service)
    {
        $service->translitName(Category::query());
        $service->translitName(EntityType::query());
    }
}
