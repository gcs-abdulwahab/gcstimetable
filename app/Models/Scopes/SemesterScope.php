<?php

namespace App\Models\Scopes;

use App\Models\Program;
use App\Models\Semester;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Scope;

class SemesterScope implements Scope
{
    /**
     * Apply the scope to a given Eloquent query builder.
     */
    public function apply(Builder $builder, Model $model): void
    {
        $institution = auth()->user()->institution;
        $department_ids = $institution->departments()->pluck('id');

        if($department_ids->isEmpty()) {
            return;
        }

        $program_ids = Program::query()
            ->whereIn('department_id', $department_ids)
            ->pluck('id');

        $semester_ids = Semester::query()
            ->whereIn('program_id', $program_ids)
            ->pluck('id');

        $builder->whereIn('semester_id', $semester_ids);
    }
}
