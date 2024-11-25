<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Traits\HasCity;
use App\Models\Traits\HasEvents;
use App\Models\Traits\HasProjects;
use App\Models\Traits\HasRegion;
use App\Models\Traits\Search;
use App\Models\Traits\HasNews;
use App\Models\Traits\HasWorks;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens,
        HasRoles,
        HasFactory,
        Notifiable,
        HasCity,
        HasRegion,
        HasProjects,
        HasEvents,
        HasWorks,
        HasNews,
        Search;


    protected $searchable = [
        'firstname',
        'email',
        'phone'
    ];

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function inGroups(): BelongsToMany
    {
        return $this->belongsToMany(Group::class);
    }

    public function isOfThe($group)
    {
        return $this->inGroups()->where('group_id', $group->id)->exists();
    }

    protected $fillable = [
        'firstname',
        'phone',
        'email',
        'password',
        'last_active_at'
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
        'last_active_at' => 'datetime:Y-m-d H:i:s',
    ];
}
