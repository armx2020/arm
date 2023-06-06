<?php

namespace App\Models;

use App\Models\Traits\HasCity;
use App\Models\Traits\HasParent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vacancy extends Model
{
    use HasFactory, HasCity, HasParent;

    //
}
