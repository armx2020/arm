<?php

namespace App\Models;

use App\Models\Traits\HasCity;
use App\Models\Traits\HasEvents;
use App\Models\Traits\HasNews;
use App\Models\Traits\HasProjects;
use App\Models\Traits\HasRegion;
use App\Models\Traits\HasUser;
use App\Models\Traits\HasVacancies;
use App\Models\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;


class Group extends Model
{
    use HasFactory, 
        HasCity,
        HasRegion,
        HasUser,
        HasEvents,
        HasProjects,
        HasNews,
        HasVacancies;
    use Search;
 
    protected $searchable = [
        'name', 'description'
    ];

    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class);
    }

    public function isOfThe($user)
    {
        return $this->users()->where('user_id', $user->id)->exists();
    }

    public function category(): BelongsTo
    {
        return $this->belongsTo(GroupCategory::class, 'group_category_id');
    }
}
