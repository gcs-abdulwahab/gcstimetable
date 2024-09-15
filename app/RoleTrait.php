<?php

namespace App;

trait RoleTrait
{
    public function isInstitutionAdmin(): bool
    {
        return $this->hasRole(RoleEnum::INSTITUTE_ADMIN->value);
    }

    public function isDepartmentAdmin(): bool
    {
        return $this->hasRole(RoleEnum::DEPARTMENT_ADMIN->value);
    }

    public function isSuperadmin(): bool
    {
        return $this->hasRole(RoleEnum::SUPER_ADMIN->value);
    }
}
