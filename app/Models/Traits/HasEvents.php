<?php

namespace App\Models\Traits;

use App\Models\Event;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasEvents
{
    public function events(): MorphMany
    {
        return $this->morphMany(Event::class, 'parent');
    }
}