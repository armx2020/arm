<?php

namespace App\Models;

use App\Models\Scopes\ActiveScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([ActiveScope::class])]

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path', 'activity', 'sort_id', 'checked'
    ];

    public function imageable(): MorphTo
    {
        return $this->morphTo();
    }

    public function scopeMain($query)
    {
        return $query->where('sort_id', 0);
    }

    public function scopeActive($query)
    {
        return $query->where('activity', 1);
    }
}
