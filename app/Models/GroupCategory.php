<?php

namespace App\Models;

use App\Models\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class GroupCategory extends Model
{
    use HasFactory;
    use Search;


    protected $searchable = [
        'name'
    ];

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }
}
