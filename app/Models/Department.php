<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;


 //Department has many teachers
    public function teachers()
    {
        return $this->hasMany(Teacher::class);
    }

// Department has many Programs
    public function programs()
    {
        return $this->hasMany(Program::class);
    }



}
