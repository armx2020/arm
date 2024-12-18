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
    ];


    protected $searchable = [
        'name',
    ];

    public function entities(): HasMany
    {
        return $this->hasMany(Entity::class);
    }
}
