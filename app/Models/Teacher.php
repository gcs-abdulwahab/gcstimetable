<?php

namespace App\Models;

use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;


    // blacklist
    protected $guarded = [];



    // Teacher Belongs to Department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // Teacher has many Allocations
    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }

    // Teacher Belongs to some Institution
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }


    // Teacher model
    public function courses()
    {

            // Can be done using Eager Loading

        return $this->belongsToMany(Course::class, 'allocations')
            ->withPivot(['day_id', 'slot_id', 'room_id']);
                
            
    }
}
