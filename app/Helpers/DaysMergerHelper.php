<?php

namespace App\Helpers;




class DaysMergerHelper
{

    // $days will be like [1,2,3,4,5]
    // if they are consecutive days then it will return "1-5"
    // if they are not consecutive then it will return "1-2,4-5"
    // now make a function toText
    // it will take an array of days and return a string like "(1-2),(4-5)"
    function toText($days) {
        if (empty($days)) {
            return "";
        }
    
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
 
    

}
