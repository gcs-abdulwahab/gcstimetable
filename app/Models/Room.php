<?php

namespace App\Models;

use App\Models\Scopes\AdminScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    // guarded
    protected $fillable = [
        'name',
        'code',
        'capacity',
        'type',
        'isavailable'
    ];

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        parent::addGlobalScope(new AdminScope);
    }

    // Room has many Allocations
    public function allocations(): HasMany
    {
        return $this->hasMany(Allocation::class);
    }

    // Room belongs to an Institution
    public function institution(): BelongsTo
    {
        return $this->belongsTo(Institution::class);
    }

}
