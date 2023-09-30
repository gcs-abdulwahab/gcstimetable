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
    // create a function has Section if section id is not null then return true else false
    public function hasSection()
    {
        return $this->section_id ? true : false;
    }

    public function hasDay()
    {
        return $this->day_id ? true : false;
    }

    public function hasSlot()
    {
        return $this->slot_id ? true : false;
    }



    public function getExistingAllocation($fields)
    {
        $query = Allocation::query();
        foreach ($fields as $key => $value) {
            $query->where($key, $value);
        }
        return $query->first();
    }



    // create a function doesExists that accepts the array of fields like day_id , slot_id , teacher_id , room_id , course_id , section_id
    // and check if the allocation is unique or not
    // the parameter list is dyanmic and where query should be updated accordingly

    public function doesExist($fields)
    {
        $query = Allocation::query();
        foreach ($fields as $key => $value) {
            $query->where($key, $value);
        }
        return $query->exists();
    }


    // create a model event creating to check if the allocation is valid or not
    protected static function booted()
    {
        static::creating(function (Allocation $allocation) {

            Log::info('in the creating function of allocation model    ' . $allocation->course);

            $dayid  = $allocation->day->id;
            $slotid = $allocation->slot->id;
            $teacherid = $allocation->teacher->id;


            $roomid = $allocation->room_id;
            $courseid = $allocation->course_id;
            $sectionid = $allocation->section_id;

            
            // day and slot must be there
            if (!$allocation->hasDay() || !$allocation->hasSlot()) {
                throw new Exception('Allocation must have a day and a slot');
            }
            
            // if hasRoom and doesnot have a teacher or course then it should throw Exception
            if ($allocation->hasRoom() && (!$allocation->hasTeacher() || !$allocation->hasCourse())) {
                throw new Exception('Room allocation must have a teacher and a course');
            }
            
            // if a Teacher is there then there must be a course
            if ($allocation->hasTeacher() && !$allocation->hasCourse()) {
                throw new Exception('Teacher allocation must have a course');
            }
            
            // if allocation has a course then section must be there
            if ($allocation->hasCourse() && !$allocation->hasSection()) {
                throw new Exception('Course allocation must have a section');
            }
            // if a record is there with the same day_id and slot_id and teacher_id with some course id   then even the courseid is changed it should not pass
            $fields = ['day_id' => $dayid, 'slot_id' => $slotid, 'teacher_id' => $teacherid , 'course_id' => $courseid];
          
           
            if ($allocation->doesExist(['day_id' => $dayid, 'slot_id' => $slotid, 'teacher_id' => $teacherid , 'course_id' => $courseid]) ) {
                
                Log::info('Merger :: Allocation Does Exist     ' . $allocation->course);
                
               
                $existingAllocation = $allocation->getExistingAllocation(['day_id' => $dayid, 'slot_id' => $slotid, 'teacher_id' => $teacherid ]);
           
                if ($existingAllocation->course->display_code != $allocation->course->display_code) {
                    throw new Exception('Allocation does exist with different code  ;  Merge was only allowed when course code is same' . json_encode($fields));
                }
                if ($existingAllocation->course->id === $allocation->course->id) {
                    throw new Exception('Allocation does exist: duplicate' . json_encode($fields)   );
                }

            }
            else{
                Log::info('Merger :: Allocation Does not Exist     ' . $allocation->course);
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
