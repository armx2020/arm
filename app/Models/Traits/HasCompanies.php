<?php

namespace App\Models\Traits;

use App\Models\Company;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasCompanies
{
    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }
}