<?php

namespace App\Models;

use App\Models\Traits\HasCity;
use App\Models\Traits\HasParent;
use App\Models\Traits\HasRegion;
use App\Models\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Event extends Model
{
    use HasFactory, HasCity, HasParent, HasRegion;
    use Search;

    public function category(): BelongsTo
    {
        return $this->belongsTo(EventCategory::class, 'event_category_id');
    }

    protected $searchable = [
        'name', 'description'
    ];    
}
