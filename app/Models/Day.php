<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Day extends Model
{
    use HasFactory;

    // add fillables
    protected $fillable = [
        'name',
        'code',
        'number'
    ];


    // Day has many Allocations
    public function allocations()
    {
        return $this->hasMany(Allocation::class);
    }
}
