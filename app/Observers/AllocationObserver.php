<?php

namespace App\Observers;

use App\Models\Allocation;
use Exception;
use Illuminate\Support\Facades\Log;

class AllocationObserver
{
    /**
     * Handle the Allocation "creating" event.
     */
    public function creating(Allocation $allocation)
    {
        // dd($allocation);
        Log::info('in the creating function of allocation model    '.$allocation->course);

        $dayid = $allocation->day_id;
        $slotid = $allocation->slot_id;
        $teacherid = $allocation->teacher_id;

        $roomid = $allocation->room_id;
        $courseid = $allocation->course_id;
        $sectionid = $allocation->section_id;

        // day and slot must be there
        if (! $allocation->hasDay() || ! $allocation->hasSlot()) {
            throw new Exception('Allocation must have a day and a slot');
        }
        //TODO: do we really have to allocate the teacher    please revise
        // if hasRoom and doesnot have a teacher or course then it should throw Exception
        if ($allocation->hasRoom() && (! $allocation->hasTeacher() || ! $allocation->hasCourse())) {
            throw new Exception('Room allocation must have a teacher and a course');
        }

        // if a Teacher is there then there must be a course
        if ($allocation->hasTeacher() && ! $allocation->hasCourse()) {
            throw new Exception('Teacher allocation must have a course');
        }

        // if allocation has a course then section must be there
        if ($allocation->hasCourse() && ! $allocation->hasSection()) {
            throw new Exception('Course allocation must have a section');
        }

        // Validate only when all fields are not null
        if ($dayid !== null && $slotid !== null && $teacherid !== null && $courseid !== null) {
            // if a record is there with the same day_id and slot_id and teacher_id with some course id then even the courseid is changed it should not pass
            $fields = ['day_id' => $dayid, 'slot_id' => $slotid, 'teacher_id' => $teacherid, 'course_id' => $courseid];

            if ($allocation->doesExist(['day_id' => $dayid, 'slot_id' => $slotid, 'teacher_id' => $teacherid, 'course_id' => $courseid])) {

                Log::info('Merger :: Allocation Does Exist '.$allocation->course);

                $existingAllocation = $allocation->getExistingAllocation(['day_id' => $dayid, 'slot_id' => $slotid, 'teacher_id' => $teacherid]);

                if ($existingAllocation->course->display_code != $allocation->course->display_code) {
                    throw new Exception('Allocation does exist with different code  ;  Merge was only allowed when course code is same'.json_encode($fields));
                }
                if ($existingAllocation->course->id === $allocation->course->id) {
                    throw new Exception('Allocation does exist: duplicate'.json_encode($fields));
                }
            } else {
                Log::info('Merger :: Allocation Does not Exist     '.$allocation->course);
            }
        }
    }

    /**
     * Handle the Allocation "created" event.
     */
    public function created(Allocation $allocation): void
    {
        //
    }

    /**
     * Handle the Allocation "updated" event.
     */
    public function updated(Allocation $allocation): void
    {
        //
    }

    /**
     * Handle the Allocation "deleted" event.
     */
    public function deleted(Allocation $allocation): void
    {
        //
    }

    /**
     * Handle the Allocation "restored" event.
     */
    public function restored(Allocation $allocation): void
    {
        //
    }

    /**
     * Handle the Allocation "force deleted" event.
     */
    public function forceDeleted(Allocation $allocation): void
    {
        //
    }
}
