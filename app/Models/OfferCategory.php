<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class OfferCategory extends Model
{
    use HasFactory;

    public function offers() : HasMany
    {
        return $this->hasMany(CompanyOffer::class);
    }
}
