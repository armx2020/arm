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
    use HasFactory, HasCity, HasRegion;
    use Search;

    protected $searchable = [
        'name', 'description'
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(OfferCategory::class,  'offer_category_id');
    }

    public function company(): BelongsTo
    {
        return $this->belongsTo(Company::class);
    }
}
