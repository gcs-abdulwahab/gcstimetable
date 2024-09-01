<?php

namespace App;

trait RoleTrait
{
    public function isInstitutionAdmin(): bool
    {
        return $this->hasRole('iadmin');
    }

    public function isDepartmentAdmin(): bool
    {
        return $this->hasRole('dadmin');
    }

    public function isSuperadmin(): bool
    {
        return $this->hasRole('sadmin');
    }
}
