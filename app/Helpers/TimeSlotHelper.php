<?php

namespace App\Helpers;
use App\Types\TimeSlot;



class TimeSlotHelper
{

    /**
     * Check if two TimeSlot objects overlap.
     *
     * @param TimeSlot $timeSlot1
     * @param TimeSlot $timeSlot2
     * @return bool
     */
    public static function isOverlapping(TimeSlot $timeSlot1, TimeSlot $timeSlot2)
    {
        // Convert 24-hour time format to timestamps
        $start1 = strtotime($timeSlot1->startTime);
        $end1 = strtotime($timeSlot1->endTime);
        $start2 = strtotime($timeSlot2->startTime);
        $end2 = strtotime($timeSlot2->endTime);

        return ($start1 < $end2 && $end1 > $start2);
    }
}
