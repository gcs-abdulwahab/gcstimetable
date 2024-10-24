<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Day extends Model
{
    use HasFactory;

    // Day has many Allocations
    public function allocations(): HasMany
    {
        return $this->hasMany(Allocation::class);
    }

    // Day belongs to an Institution
    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }
}
