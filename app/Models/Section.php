<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;

  // guarded
    protected $guarded = [];


    // Section Belongs to a Semester
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }

    // Section has many Courses
    public function courses()
    {
        return $this->hasMany(Course::class);
    }


}
