<?php

namespace App\Models;

use App\Models\Traits\HasCity;
use App\Models\Traits\HasUser;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Resume extends Model
{
    use HasFactory, HasCity, HasUser;


    public function experiences(): HasMany
    {
        return $this->hasMany(Experience::class);
    }
}
