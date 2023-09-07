<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;


    // Room has many Allocations
    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }


}
