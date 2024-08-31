<?php

use App\Types\TimeSlot;

function DaystoText($days)
{
    if (empty($days)) {
        return "";
    }

    // remove duplicates from the array
    $days = array_unique($days);

    sort($days); // Sort the days in ascending order
    $ranges = array();
    $start = $end = $days[0];

    for ($i = 1; $i < count($days); $i++) {
        if ($days[$i] == $end + 1) {
            $end = $days[$i];
        } else {
            if ($start == $end) {
                $ranges[] = $start;
            } else {
                $ranges[] = $start . '-' . $end;
            }
            $start = $end = $days[$i];
        }
    }

    if ($start == $end) {
        $ranges[] = $start;
    } else {
        $ranges[] = $start . '-' . $end;
    }

    // Format the result
    $formattedRanges = array_map(function ($range) {
        return '(' . $range . ')';
    }, $ranges);

    return implode(' ', $formattedRanges);
}


/**
     * Check if two TimeSlot objects overlap.
     *
     * @param TimeSlot $timeSlot1
     * @param TimeSlot $timeSlot2
     * @return bool
     */
function isTimeSlotOverlapping(TimeSlot $timeSlot1, TimeSlot $timeSlot2)
{
    // Convert 24-hour time format to timestamps
    $start1 = strtotime($timeSlot1->startTime);
    $end1 = strtotime($timeSlot1->endTime);
    $start2 = strtotime($timeSlot2->startTime);
    $end2 = strtotime($timeSlot2->endTime);

    return ($start1 < $end2 && $end1 > $start2);
}
