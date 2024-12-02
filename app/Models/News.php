<?php

namespace App\Models;

use App\Models\Traits\HasCity;
use App\Models\Traits\HasParent;
use App\Models\Traits\HasRegion;
use App\Models\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class News extends Model
{
    use HasFactory,
        HasCity,
        HasRegion,
        HasParent,
        Search;

    protected $searchable = [
        'name',
        'description'
    ];

    public function scopeActive($query)
    {
        return $query->where('activity', 1);
    }
}
