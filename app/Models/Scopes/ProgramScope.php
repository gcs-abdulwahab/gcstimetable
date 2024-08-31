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
        $user = auth()->user();
        if ($user && $user->isInstitutionAdmin()) {
            $institution = $user->institution;
            $department_ids = $institution->departments()->pluck('id');
            if ($department_ids) {
                $program_ids = Program::query()
                    ->whereIn('department_id', $department_ids)
                    ->pluck('id');
                if ($program_ids) {
                    $builder->whereIn('program_id', $program_ids);

                    return;
                }
            }
            $builder->whereNull('program_id');
        }

        if ($user && $user->isDepartmentAdmin()) {
            $department_id = $user->department_id;
            if ($department_id) {
                $program_ids = Program::query()
                    ->whereIn('department_id', [$department_id])
                    ->pluck('id');
                if ($program_ids) {
                    $builder->whereIn('program_id', $program_ids);

                    return;
                }
            }
            $builder->whereNull('program_id');
        }
    }
}
