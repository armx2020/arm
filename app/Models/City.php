<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class City extends Model
{
    use HasFactory;

    protected $searchable = [
        'name',
    ];

    protected $fillable = ['name'];

    public $timestamps = false;

    public function users() : HasMany
    {
        return $this->hasMany(User::class);
    }

    public function companies() : HasMany
    {
        return $this->hasMany(Company::class);
    }

    public function groups() : HasMany
    {
        return $this->hasMany(Group::class);
    }

    public function offers() : HasMany
    {
        return $this->hasMany(CompanyOffer::class);
    }

    public function vacancies() : HasMany
    {
        return $this->hasMany(Vacancy::class);
    }

    public function resumies() : HasMany
    {
        return $this->hasMany(Resume::class);
    }

    public function news() : HasMany
    {
        return $this->hasMany(News::class);
    }

    public function events() : HasMany
    {
        return $this->hasMany(Event::class);
    }

    public function projects() : HasMany
    {
        return $this->hasMany(Project::class);
    }
}
