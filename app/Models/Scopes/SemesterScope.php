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
        $user = auth()->user();
        if ($user && $user->isInstitutionAdmin()) {
            $institution = $user->institution;
            if ($institution) {
                $department_ids = $institution->departments()->pluck('id');

                if ($department_ids) {
                    $program_ids = Program::query()
                        ->whereIn('department_id', $department_ids)
                        ->pluck('id');
                    if ($program_ids) {
                        $semester_ids = Semester::query()
                            ->whereIn('program_id', $program_ids)
                            ->pluck('id');
                        if ($semester_ids) {
                            $builder->whereIn('semester_id', $semester_ids);

                            return;
                        }
                    }
                }
            }
            $builder->whereNull('semester_id');
        } // End of Institution Admin Condition

        if ($user && $user->isDepartmentAdmin()) {
            $department_id = $user->department_id;
            if ($department_id) {
                $program_ids = Program::query()
                    ->whereIn('department_id', [$department_id])
                    ->pluck('id');
                if ($program_ids) {
                    $semester_ids = Semester::query()
                        ->whereIn('program_id', $program_ids)
                        ->pluck('id');
                    if ($semester_ids) {
                        $builder->whereIn('semester_id', $semester_ids);

                        return;
                    }
                }
            }
            $builder->whereNull('semester_id');
        } // End of Department User Condition
    } // end of Apply
}
