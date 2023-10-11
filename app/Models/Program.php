<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Program extends Model
{
    use HasFactory;

 // guarded
    protected $guarded = [];

    // program belongs to a department
    public function department() : BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    // program has many semesters
    public function semesters() : HasMany
    {
        return $this->hasMany(Semester::class);
    }

    public function shift() : BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }

}
