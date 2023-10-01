<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shift extends Model
{
    use HasFactory;


    // guarded
    protected $guarded = [];

    // has many slots
    public function slots()
    {
        return $this->hasMany(Slot::class);
    }



}
