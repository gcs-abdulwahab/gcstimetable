<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    use HasFactory;

    // guarded
    protected $guarded = [];
    

     // create queryscope complete
        // public function scopeComplete($query)
        // {
        //     return $query->whereNotNull('day_id')
        //         ->whereNotNull('slot_id')
        //         ->whereNotNull('teacher_id')
        //         ->whereNotNull('room_id')
        //         ->whereNotNull('course_id')
        //         ->whereNotNull('section_id');
        // }

        // // create queryscope incomplete
        // public function scopeIncomplete($query)
        // {
        //     return $query->whereNull('day_id')
        //         ->orWhereNull('slot_id')
        //         ->orWhereNull('teacher_id')
        //         ->orWhereNull('course_id')
        //         ->orWhereNull('room_id')
        //         ->orWhereNull('section_id');
        // }


    // create dynamic queryscope complete  on passing the boolean true  it returns the complete allocations and vice verca
    // and by default its true
    public function scopeComplete($query, $complete = true)
    {
        if ($complete) {
            return $query->whereNotNull('day_id')
                ->whereNotNull('slot_id')
                ->whereNotNull('teacher_id')
                ->whereNotNull('room_id')
                ->whereNotNull('course_id')
                ->whereNotNull('section_id');
        } else {
            return $query->whereNull('day_id')
                ->orWhereNull('slot_id')
                ->orWhereNull('teacher_id')
                ->orWhereNull('course_id')
                ->orWhereNull('room_id')
                ->orWhereNull('section_id');
        }
    }
    
    






    // courses
    public function course()
    {
        return $this->belongsTo(Course::class,'course_id');
    }

    // teachers
    public function teacher()
    {
        return $this->belongsTo(Teacher::class,'teacher_id');
    }

// rooms
    public function room()
    {
        return $this->belongsTo(Room::class,'room_id');
    }

    // slots
    public function slot()
    {
        return $this->belongsTo(Slot::class,'slot_id');
    }

    // days
    public function day()
    {
        return $this->belongsTo(Day::class,'day_id');
    }

    




}
