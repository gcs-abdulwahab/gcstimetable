<?php

use App\Models\Allocation;
use App\Models\Course;
use App\Models\Day;
use App\Models\Room;
use App\Models\Slot;
use App\Models\Teacher;
use Illuminate\Support\Facades\Log;

class Constraint
{
    public Allocation $allocation;

    // overload the constructor which also accepts the  Allocation Parameter
    public function __construct(Allocation $allocation)
    {
        Log::info('in the constraint class');
        $this->allocation = $allocation;

    }

    public function canTeacherTeachCourseAtTimeSlot(): bool
    {
        /*
                  // Check if the teacher is already allocated to another course in the same day, same timeslot.
                $otherCourses = $teacher->courses()->where('slot_id', $timeslot)->where('day_id', )->get();
                if ($otherCourses->count() > 0) {
                    return false;
                }

                // Check if the course is already allocated to another room in the same day and time slot to any other teacher.
                $otherRooms = $course->rooms()->where('timeslot', $timeslot)->where('day', $course->day)->get();
                foreach ($otherRooms as $room) {
                    $otherTeachers = $room->teachers()->where('timeslot', $timeslot)->where('day', $course->day)->get();
                    if ($otherTeachers->count() > 0) {
                        return false;
                    }
                }
         */
        // return true;

        return false;
    }
}
