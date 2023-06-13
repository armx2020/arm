<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Traits\HasCity;
use App\Models\Traits\HasCompanies;
use App\Models\Traits\HasEvents;
use App\Models\Traits\HasGroups;
use App\Models\Traits\HasProjects;
use App\Models\Traits\HasResumes;
use App\Models\Traits\HasVacancies;
use App\Models\Traits\Search;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
// use Laravel\Scout\Searchable;

class User extends Authenticatable
{
    use HasApiTokens,
        HasFactory,
        Notifiable,
        HasCity,
        HasCompanies,
        HasGroups,
        HasResumes,
        HasProjects,
        HasEvents,
        HasVacancies;
    use Search;


    protected $searchable = [
        'firstname',
        'lastname',
        'email'
    ];


    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstname',
        'lastname',
        'phone',
         'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

}
