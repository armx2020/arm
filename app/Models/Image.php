<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path', 'activity', 'main'
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeMain($query)
    {
        return $query->where('main', 1);
    }

    public function scopeActive($query)
    {
        return $query->where('activity', 1);
    }
}
