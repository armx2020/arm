<?php

namespace App\Models;

use App\Models\Traits\HasCity;
use App\Models\Traits\HasRegion;
use App\Models\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyOffer extends Model
{
    use HasFactory,
        HasCity,
        HasRegion,
        Search;

    protected $searchable = [
        'name',
        'description'
    ];

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }


    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class,  'category_id');
    }

    public function scopeActive($query)
    {
        return $query->where('activity', 1);
    }
}
