<?php

namespace App\Models;

use App\Models\Institution;
use App\Models\Scopes\AdminScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Day extends Model
{
    use HasFactory;
    // guarded
    protected $guarded = [];


    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        parent::addGlobalScope(new AdminScope);
    }



    // Day has many Allocations
    public function allocations() : HasMany
    {
        return $this->hasMany(Allocation::class);
    }

    // Day belongs to an Institution
    public function institution() : BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }
}
