<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SortDescScope implements Scope
{
    public function apply(Builder $builder, Model $model): void
    {
        $builder->orderBy ('sort_id', 'desc');
    }
}
