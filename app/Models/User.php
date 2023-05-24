<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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

    public function city(): BelongsTo
    {
        return $this->belongsTo(City::class);
    }

    public function companies(): HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function groups(): HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function resumes(): HasMany
    {
        return $this->hasMany(Resume::class);
    }

    public function projects(): MorphMany
    {
        return $this->morphMany(Project::class, 'parenttable');
    }

    public function events(): MorphMany
    {
        return $this->morphMany(Event::class, 'parenttable');
    }

    public function vacancies(): MorphMany
    {
        return $this->morphMany(Vacancy::class, 'parenttable');
    }
}
