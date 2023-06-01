<?php

namespace App\Models\Traits;

use App\Models\Vacancy;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasVacancies
{
  public function vacancies(): MorphMany
    {
        return $this->morphMany(Vacancy::class, 'parent');
    }
}