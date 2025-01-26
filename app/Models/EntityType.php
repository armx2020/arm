<?php

namespace App\Models;

use App\Models\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class EntityType extends Model
{
    use HasFactory, Search;

    protected $fillable = [
        'name',
        'activity'
    ];


    protected $searchable = [
        'name',
    ];

    public function scopeActive($query)
    {
        return $query->where('activity', 1);
    }

    public function entities(): HasMany
    {
        return $this->hasMany(Entity::class);
    }

    public function categories(): HasMany
    {
        return $this->hasMany(Category::class);
    }
}
