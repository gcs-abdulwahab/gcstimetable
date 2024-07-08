<?php

namespace App\Models;

use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    protected $guarded = [];

    // Slot belongs to a Shift
    public function shift()
    {
        return $this->belongsTo(Shift::class);
    }

    // Slot has many Allocations
    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }

 


}
