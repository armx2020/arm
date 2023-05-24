<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Company extends Model
{
    use HasFactory;

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function offer(): HasMany
    {
        return $this->hasMany(CompanyOffer::class);
    }

    public function group(): BelongsTo
    {
        return $this->belongsTo(Group::class);
    }

    public function projects(): MorphMany
    {
        return $this->morphMany(Project::class, 'parenttable');
    }

    public function events(): MorphMany
    {
        return $this->morphMany(Event::class, 'parenttable');
    }

    public function vacancies(): MorphMany
    {
        return $this->morphMany(Vacancy::class, 'parenttable');
    }
}
