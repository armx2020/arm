<?php

namespace App\Models;

use App\Models\Scopes\SortScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\Attributes\ScopedBy;

#[ScopedBy([SortScope::class])]

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

}
