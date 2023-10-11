<?php

namespace App\Models\Scopes;

use App\Enums\User\Role;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class AdminScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        // if (auth()->user()->role_id ===    ) {
        //     $builder->where('institution_id', auth()->user()->institution_id);
        // }
    }
}
