<?php

namespace App;

trait IsActiveTrait
{
    // Scopes
    public function scopeWhereActive()
    {
        return $this->where('is_active', 'active');
    }

    public function scopeWhereInactive()
    {
        return $this->where('is_active', 'inactive');
    }

    // helpers
    public function isActive()
    {
        return $this->is_active === 'active';
    }

    public function isInactive()
    {
        return $this->is_active === 'inactive';
    }
}
