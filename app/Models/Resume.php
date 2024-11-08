<?php

namespace App\Models;

use App\Models\Traits\HasCity;
use App\Models\Traits\HasRegion;
use App\Models\Traits\HasUser;
use App\Models\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resume extends Model
{
    use HasFactory, HasCity, HasRegion, HasUser;
    use Search;

    protected $searchable = [
        'name', 'description'
    ];
}
