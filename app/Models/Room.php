<?php

namespace App\Models;

use App\Models\Scopes\InstitutionScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Room extends Model
{
    use HasFactory;

    public function isBsRoom(): bool
    {
        return strtoupper($this->type) === 'BS';
    }

    public function isInterRoom(): bool
    {
        return strtoupper($this->type) === 'INTERMEDIATE';
    }

    public function isBothInterAndBsRoom(): bool
    {
        return strtoupper($this->type) === 'BOTH';
    }

    /**
     * The "booted" method of the model.
     */
    protected static function booted(): void
    {
        parent::addGlobalScope(new InstitutionScope);
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
