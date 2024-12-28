<?php

namespace App\Models;

use App\Models\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, Search;

    protected $searchable = [
        'name'
    ];

    protected $fillable = ['id', 'name'];

    public function scopeMain($query)
    {
        return $query->where('category_id', null);
    }

    public function scopeActive($query)
    {
        return $query->where('activity', 1);
    }

    public function scopeCompanies($query)
    {
        return $query->where('entity_type_id', 1);
    }


    public function scopeGroups($query)
    {
        return $query->where('entity_type_id', 2);
    }

    public function scopePlaces($query)
    {
        return $query->where('entity_type_id', 3);
    }

    public function scopeCommunities($query)
    {
        return $query->where('entity_type_id', 4);
    }

    public function scopeEvent($query) // TODO удалить после переноса сущностей
    {
        return $query->where('type_old', 'event');
    }

    public function scopeOffer($query) // TODO удалить после переноса сущностей
    {
        return $query->where('type_old', 'offer');
    }

    public function events(): HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(CompanyOffer::class);
    }

    public function categories()
    {
        return $this->hasMany(Category::class);
    }

    public function childrenCategories()
    {
        return $this->hasMany(Category::class)->with('categories');
    }

    public function parent()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function companies(): BelongsToMany
    {
        return $this->belongsToMany(Company::class);
    }

    public function type(): BelongsTo
    {
        return $this->belongsTo(EntityType::class, 'entity_type_id');
    }
}
