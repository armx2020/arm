<?php

namespace App\Models;

use App\Models\Traits\HasCity;
use App\Models\Traits\HasParent;
use App\Models\Traits\HasRegion;
use App\Models\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Work extends Model
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

    public function scopeVacancy($query)
    {
        return $query->where('type', 'vacancy');
    }

    public function scopeResume($query)
    {
        return $query->where('type', 'resume');
    }

    public function scopeActive($query)
    {
        return $query->where('activity', 1);
    }
}
