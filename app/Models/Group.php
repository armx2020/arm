<?php

namespace App\Models;

use App\Models\Traits\HasCity;
use App\Models\Traits\HasEvents;
use App\Models\Traits\HasProjects;
use App\Models\Traits\HasUser;
use App\Models\Traits\HasVacancies;
use App\Models\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Group extends Model
{
    use HasFactory, HasCity, HasUser, HasEvents, HasProjects, HasVacancies;
    use Search;


    protected $searchable = [
        'name', 'description'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(GroupCategory::class, 'group_category_id');
    }
}
