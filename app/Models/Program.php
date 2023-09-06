<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Program extends Model
{
    use HasFactory;


    // program belongs to a department
    public function department()
    {
        return $this->belongsTo(Department::class);
    }
}
