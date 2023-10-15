<?php

namespace App\Models\Scopes;

use App\Models\Program;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class ProgramScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $user= auth()->user();
        if($user && $user->isInstitutionAdmin()){
            $institution = $user->institution;
            $department_ids = $institution->departments()->pluck('id');

            if ($department_ids->isEmpty()) {
                return;
            }
            $program_ids = Program::query()
                ->whereIn('department_id', $department_ids)
                ->pluck('id');

            $builder->whereIn('program_id', $program_ids);
        }

        if($user && $user->isDepartmentAdmin()){
            $department_id = $user->department->id;

            if ($department_id->isEmpty()) {
                return;
            }

            $program_ids = Program::query()
                ->whereIn('department_id', [$department_id])
                ->pluck('id');

            $builder->whereIn('program_id', $program_ids);
        }
    }
}
