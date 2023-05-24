<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Group extends Model
{
    use HasFactory;

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(GroupCategory::class);
    }

    public function projects(): MorphMany
    {
        return $this->morphMany(Project::class, 'parenttable');
    }

    public function events(): MorphMany
    {
        return $this->morphMany(Event::class, 'parenttable');
    }
}
