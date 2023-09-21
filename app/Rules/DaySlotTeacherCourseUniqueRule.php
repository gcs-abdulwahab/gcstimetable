<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Support\Facades\DB;

class DaySlotTeacherCourseUniqueRule implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        $fail('The selected combination of day, slot, teacher, and course is not unique.');
        [$day_id, $slot_id, $teacher_id, $course_id] = explode('-', $value);

        $count = DB::table('allocations')
            ->where('day_id', $day_id)
            ->where('slot_id', $slot_id)
            ->where('teacher_id', $teacher_id)
            ->where('course_id', $course_id)
            ->count();
            
        if ($count > 0) {
            $fail('The selected combination of day, slot, teacher, and course is not unique.');
        }
       
    }
}
