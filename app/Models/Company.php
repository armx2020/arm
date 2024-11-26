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
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

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

    public function actions(): BelongsToMany
    {
        return $this->belongsToMany(Action::class);
    }
}
