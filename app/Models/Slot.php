<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Slot extends Model
{
    use HasFactory;

    // Slot has many Allocations
    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }



}
