<?php

namespace App\Models\Traits;

use App\Models\Resume;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasResumes
{
    public function resumes(): HasMany
    {
        return $this->hasMany(Resume::class);
    }
}