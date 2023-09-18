<?php

namespace App\Models;

use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

  // guarded
    protected $guarded = [];

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

    // Department belongs to an Institution
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }


}
