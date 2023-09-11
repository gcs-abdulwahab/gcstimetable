<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Semester extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'number',
        'is_active',
        'program_id'
    ];


    // Semester Has Many Sections
    public function sections()
    {
        return $this->hasMany(Section::class);
    }

    // Semester has many Courses
    public function courses()
    {
        return $this->hasMany(Course::class);
    }


    // belongs to a program
    public function program()
    {
        return $this->belongsTo(Program::class);
    }

}
