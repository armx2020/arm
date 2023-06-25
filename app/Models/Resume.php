<?php

namespace App\Models;

use App\Models\Traits\HasCity;
use App\Models\Traits\HasUser;
use App\Models\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Relations\HasMany;

class Resume extends Model
{
    use HasFactory, HasCity, HasUser;
    use Search;

    protected $searchable = [
        'name', 'description'
    ];
}
