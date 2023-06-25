<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\Traits\HasCity;
use App\Models\Traits\HasEvents;
use App\Models\Traits\HasProjects;
use App\Models\Traits\HasUser;
use App\Models\Traits\HasVacancies;
use App\Models\Traits\Search;

class Company extends Model
{
    use HasFactory, HasCity, HasProjects, HasEvents, HasVacancies, HasUser;
    use Search;


    protected $searchable = [
        'name', 'description'
    ];

    public function offer(): HasMany
    {
        return $this->hasMany(CompanyOffer::class);
    }
}
