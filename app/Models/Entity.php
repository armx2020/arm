<?php

namespace App\Models;

use App\Models\Traits\HasCity;
use App\Models\Traits\HasEvents;
use App\Models\Traits\HasNews;
use App\Models\Traits\HasProjects;
use App\Models\Traits\HasRegion;
use App\Models\Traits\HasUser;
use App\Models\Traits\HasWorks;
use App\Models\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Entity extends Model
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

    protected $fillable = [
        'name',
        'entity_type_id',
        'activity',
        'address',
        'link',
        'email',
        'director',
        'image',
        'description',
        'phone',
        'web',
        'whatsapp',
        'instagram',
        'vkontakte',
        'telegram',
        'user_id',
        'city_id',
        'region_id',
        'category_id',
        'sort_id'
    ];

    protected $searchable = [
        'name',
        'phone',
        'description'
    ];

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

    public function type(): BelongsTo
    {
        return $this->belongsTo(EntityType::class, 'entity_type_id');
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function region(): BelongsTo
    {
        return $this->belongsTo(Region::class);
    }

    public function fields(): BelongsToMany
    {
        return $this->belongsToMany(Category::class)->withTimestamps();
    }

    public function main_field(): BelongsToMany
    {
        return $this->belongsToMany(Category::class, 'category_entity', 'entity_id', 'main_entity_id')->withTimestamps();
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
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
