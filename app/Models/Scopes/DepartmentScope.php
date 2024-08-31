<?php

namespace App\Models\Scopes;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class DepartmentScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user = auth()->user();

        if ($user) {
            if ($user->isInstitutionAdmin()) {

                $institution = $user->institution;
                if ($institution) {
                    $departments = $institution->departments;
                    if ($departments) {
                        $builder->whereIn('department_id', $departments->pluck('id'));

                        return;
                    }
                }
                $builder->whereNull('department_id');
            } elseif ($user->isDepartmentAdmin()) {

                $builder->whereIn('department_id', [$user->department_id]);
            }
        }
    }
}
