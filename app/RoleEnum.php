<?php

namespace App;

enum RoleEnum: string
{
    case SUPER_ADMIN        = 'super admin';
    case INSTITUTE_ADMIN    = 'institution admin';
    case DEPARTMENT_ADMIN   = 'department admin';
    case STUDENT            = 'student';
    case TEACHER            = 'teacher';

    public static function getLabel(string $role): string
    {
        return match ($role) {
            self::SUPER_ADMIN->value => 'Super Admin',
            self::INSTITUTE_ADMIN->value => 'Institute Admin',
            self::DEPARTMENT_ADMIN->value => 'Department Admin',
            self::STUDENT->value => 'Student',
            self::TEACHER->value => 'Teacher',
            default => 'User Role',
        };
    }

    public static function toArray(): array
    {
        return [
            'SUPER_ADMIN'       => self::SUPER_ADMIN,
            'INSTITUTE_ADMIN'   => self::INSTITUTE_ADMIN,
            'DEPARTMENT_ADMIN'  => self::DEPARTMENT_ADMIN,
            'STUDENT'           => self::STUDENT,
            'TEACHER'           => self::TEACHER,
        ];
    }
}
