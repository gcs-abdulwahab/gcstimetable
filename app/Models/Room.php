<?php

namespace App\Models;

use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;

            //fillables
            protected $fillable = [
                'name',
                'code',
                'capacity',
                'type',
                'isavailable'
            ];

    // Room has many Allocations
    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }

    // Room belongs to an Institution
    public function institution()
    {
        return $this->belongsTo(Institution::class);
    }

}
