<?php

namespace App\Models;

use App\Models\Scopes\DepartmentScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;

class Program extends Model
{
    use HasFactory;

    // guarded

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        parent::addGlobalScope(new DepartmentScope);
    }

    // program belongs to a department
    public function department(): BelongsTo
    {
        return $this->belongsTo(Department::class);
    }

    // program has many semesters
    public function semesters(): HasMany
    {
        return $this->hasMany(Semester::class);
    }

    public function shift(): BelongsTo
    {
        return $this->belongsTo(Shift::class);
    }

    public function institution(): HasOneThrough
    {
        return $this->hasOneThrough(Institution::class, Department::class, 'id', 'id', 'department_id', 'institution_id');
    }
}
