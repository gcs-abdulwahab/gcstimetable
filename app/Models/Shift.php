<?php

namespace App\Models;

use App\Models\Scopes\AdminScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shift extends Model
{
    use HasFactory;


    // guarded
    protected $guarded = [];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new AdminScope);
    }

    // has many slots
    public function slots() : HasMany
    {
        return $this->hasMany(Slot::class);
    }


    // has many programs
    public function programs() : HasMany
    {
        return $this->hasMany(Program::class);
    }

    public function institution() : BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

}
