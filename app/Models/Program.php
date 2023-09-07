<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;

    // add fillables
    protected $fillable = [
        'name',
        'code',
        'duration',
        'type',
        'isMorning',
        'department_id'
    ];
    


    // program belongs to a department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    // program has many semesters
    public function semesters()
    {
        return $this->hasMany(Semester::class);
    }

}
