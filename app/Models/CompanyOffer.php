<?php

namespace App\Models;

use App\Models\Traits\HasCity;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class CompanyOffer extends Model
{
    use HasFactory, HasCity;

    public function category(): BelongsTo
    {
        return $this->belongsTo(OfferCategory::class,  'offer_category_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
