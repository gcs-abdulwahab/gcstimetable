<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Allocation extends Model
{
    use HasFactory;

    // guarded
    protected $guarded = [];
    

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
