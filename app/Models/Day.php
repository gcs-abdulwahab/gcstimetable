<?php

namespace App\Models;

use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;
    // guarded
    protected $guarded = [];



    // Day has many Allocations
    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }

    // Day belongs to an Institution
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }
}
