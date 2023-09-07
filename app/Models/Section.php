<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Section extends Model
{
    use HasFactory;


    // Section Belongs to a Semester
    public function semester()
    {
        return $this->belongsTo(Semester::class);
    }


}
