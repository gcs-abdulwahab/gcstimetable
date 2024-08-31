<?php

namespace App\Models;

use App\Models\Institution;
use App\Models\Scopes\InstitutionScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Department extends Model
{
    use HasFactory;

  // guarded
    

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        static::addGlobalScope(new InstitutionScope);
    }

 //Department has many teachers
    public function teachers() : HasMany
    {
        return $this->hasMany(Teacher::class);
    }

// Department has many Programs
    public function programs() : HasMany
    {
        return $this->hasMany(Program::class);
    }

    // Department belongs to an Institution
    public function institution() : BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

}
