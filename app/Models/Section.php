<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Section extends Model
{
    use HasFactory;

  // guarded
    protected $guarded = [];


    // Section Belongs to a Semester
    public function semester() : BelongsTo
    {
        return $this->belongsTo(Semester::class);
    }

    // Section has many Courses
    public function courses() : HasMany
    {
        return $this->hasMany(Course::class);
    }


}
