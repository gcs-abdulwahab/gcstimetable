<?php

namespace App\Models;

use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Allocation extends Model
{
    use HasFactory;



    // guarded
    protected $guarded = [];


    // create a function hasTeacher if teacher id is not null then return true else false
    public function hasTeacher()
    {
        return $this->teacher_id ? true : false;
    }
    // create a function hasCourse if course id is not null then return true else false
    public function hasCourse()
    {
        return $this->course_id ? true : false;
    }
    // create a function hasRoom if room id is not null then return true else false
    public function hasRoom()
    {
        return $this->room_id ? true : false;
    }




    // create a model event creating to check if the allocation is valid or not
    protected static function booted()
    {
        static::creating(function (Allocation $allocation) {

            Log::info('in the creating function of allocation model    ' . $allocation->course);

            
            // if hasRoom and doesnot have a teacher or course then it should throw Exception
            if ($allocation->hasRoom() && (!$allocation->hasTeacher() || !$allocation->hasCourse())) {
                throw new Exception('Room allocation must have a teacher and a course');
            }
            


            

        });
    }


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
        return $this->belongsTo(Course::class, 'course_id');
    }

    // teachers
    public function teacher()
    {
        return $this->belongsTo(Teacher::class, 'teacher_id');
    }

    // rooms
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }

    // slots
    public function slot()
    {
        return $this->belongsTo(Slot::class, 'slot_id');
    }

    // days
    public function day()
    {
        return $this->belongsTo(Day::class, 'day_id');
    }
}
