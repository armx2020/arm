<?php

namespace App\Models;

use App\Models\Traits\HasEvents;
use App\Models\Traits\HasProjects;
use App\Models\Traits\HasVacancies;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Admin extends Authenticatable
{
    use HasFactory, Notifiable, HasEvents, HasVacancies, HasProjects;
    
    protected $guard = 'admin';

    protected $fillable = ['login', 'password'];

    protected $hidden = ['password', 'remember_token',];
}    