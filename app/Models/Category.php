<?php

namespace App\Models;

use App\Models\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory, Search;

    protected $searchable = [
        'name'
    ];

    public function scopeMain($query)
    {
        return $query->where('category_id', null);
    }

    public function scopeActive($query)
    {
        return $query->where('activity', 1);
    }

    public function scopeGroup($query)
    {
        return $query->where('type', 'group');
    }

    public function scopeEvent($query)
    {
        return $query->where('type', 'event');
    }

    public function scopeOffer($query)
    {
        return $query->where('type', 'offer');
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
}
