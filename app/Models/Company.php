<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Traits\HasCity;
use App\Models\Traits\HasEvents;
use App\Models\Traits\HasNews;
use App\Models\Traits\HasProjects;
use App\Models\Traits\HasRegion;
use App\Models\Traits\HasUser;
use App\Models\Traits\HasWorks;
use App\Models\Traits\Search;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Company extends Model
{
    use HasFactory,
        HasCity,
        HasRegion,
        HasProjects,
        HasEvents,
        HasWorks,
        HasUser,
        HasNews,
        Search;

    protected $searchable = [
        'name',
        'phone',
        'description'
    ];

    public function offers(): HasMany
    {
        return $this->hasMany(CompanyOffer::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function main_categories(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_company', 'company_id', 'main_category_id')->withTimestamps();
    }

    public function scopeActive($query)
    {
        return $query->where('activity', 1);
    }

    public function images(): MorphMany
    {
        return $this->morphMany(Image::class, 'imageable');
    }
}
