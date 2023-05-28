<?php

namespace App\Models\Traits;

use Illuminate\Database\Eloquent\Relations\BelongsTo;


trait HasCity
{
    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }
}