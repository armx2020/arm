<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Region extends Model
{
    use HasFactory;

    protected $searchable = [
        'name',
    ];

    protected $fillable = ['name'];

    public $timestamps = false;

    public function cities(): HasMany
    {
        return $this->hasMany(City::class);
    }

    public function users() : HasMany
    {
        return $this->hasMany(User::class);
    }
}
