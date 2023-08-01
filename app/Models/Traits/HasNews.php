<?php

namespace App\Models\Traits;

use App\Models\News;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasNews
{
    public function news(): MorphMany
    {
        return $this->morphMany(News::class, 'parent');
    }
}