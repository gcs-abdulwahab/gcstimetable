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
    

    // create a model event creating to check if the allocation is valid or not
    protected static function booted()
    {
        static::creating(function (Allocation $allocation) {

            // $constraint = new Constraint($allocation);


            Log::info('in the creating function of allocation model    '. $allocation->course );

            // if Course is allocated to teacher then Room ID should be mentioned 
            if (!$allocation->isTeacherAllocatedCoursewithoutRoom()) {
                Log::info('$constraint->isTeacherAllocatedCoursewithoutRoom()   constraint failed');
                throw new Exception('The teacher is already allocated to another course in the same day, same timeslot.');
            }



            
        });
    }

    public function isTeacherAllocatedCoursewithoutRoom(): bool
    {
        Log::info('in the isTeacherAllocatedCoursewithoutRoom function of allocation model');
        
        //$result = 


        return true;
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
