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

    public function entities(): HasMany
    {
        return $this->hasMany(Entity::class);
    }

    public function offers(): HasMany
    {
        return $this->hasMany(Offer::class);
    }

    protected $fillable = [
        'firstname',
        'phone',
        'email',
        'password',
        'last_active_at',
        'activity',
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
