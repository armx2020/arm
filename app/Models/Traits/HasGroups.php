<?php

namespace App\Models\Traits;

use App\Models\Group;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasGroups
{
    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }
}