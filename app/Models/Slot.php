<?php

namespace App\Models;

use App\Models\Institution;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Slot extends Model
{
    use HasFactory;
  //guarded
    

    // Slot belongs to a Shift
    public function shift() : BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }


    // Slot has many Allocations
    public function allocations() : HasMany
    {
        return $this->hasMany(Allocation::class);
    }

    // Slot belongs to an Institution
    public function institution() : BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }


}
