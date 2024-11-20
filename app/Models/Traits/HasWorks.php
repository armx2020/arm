<?php

namespace App\Models\Traits;

use App\Models\Work;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasWorks
{
  public function works(): MorphMany
    {
        return $this->morphMany(Work::class, 'parent');
    }
}