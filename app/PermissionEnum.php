<?php

namespace App;

enum PermissionEnum : string
{
    case CREATE_USER        = 'create user';
    case EDIT_USER          = 'edit user';
    case DELETE_USER        = 'delete user';
    case VIEW_USER          = 'view user';

    case CREATE_TEACHER     = 'create teacher';
    case EDIT_TEACHER       = 'edit teacher';
    case DELETE_TEACHER     = 'delete teacher';
    case VIEW_TEACHER       = 'view teacher';

    case CREATE_STUDENT     = 'create student';
    case EDIT_STUDENT       = 'edit student';
    case DELETE_STUDENT     = 'delete student';
    case VIEW_STUDENT       = 'view student';

    case CREATE_INSTITUTE   = 'create institute';
    case EDIT_INSTITUTE     = 'edit institute';
    case DELETE_INSTITUTE   = 'delete institute';
    case VIEW_INSTITUTE     = 'view institute';

    case CREATE_DEPARTMENT  = 'create department';
    case EDIT_DEPARTMENT    = 'edit department';
    case DELETE_DEPARTMENT  = 'delete department';
    case VIEW_DEPARTMENT    = 'view department';

    public static function toArray(): array
    {
        return [
            'CREATE_USER'       => self::CREATE_USER,
            'EDIT_USER'         => self::EDIT_USER,
            'DELETE_USER'       => self::DELETE_USER,
            'VIEW_USER'         => self::VIEW_USER,

            'CREATE_TEACHER'    => self::CREATE_TEACHER,
            'EDIT_TEACHER'      => self::EDIT_TEACHER,
            'DELETE_TEACHER'    => self::DELETE_TEACHER,
            'VIEW_TEACHER'      => self::VIEW_TEACHER,

            'CREATE_STUDENT'    => self::CREATE_STUDENT,
            'EDIT_STUDENT'      => self::EDIT_STUDENT,
            'DELETE_STUDENT'    => self::DELETE_STUDENT,
            'VIEW_STUDENT'      => self::VIEW_STUDENT,

            'CREATE_INSTITUTE'  => self::CREATE_INSTITUTE,
            'EDIT_INSTITUTE'    => self::EDIT_INSTITUTE,
            'DELETE_INSTITUTE'  => self::DELETE_INSTITUTE,
            'VIEW_INSTITUTE'    => self::VIEW_INSTITUTE,

            'CREATE_DEPARTMENT' => self::CREATE_DEPARTMENT,
            'EDIT_DEPARTMENT'   => self::EDIT_DEPARTMENT,
            'DELETE_DEPARTMENT' => self::DELETE_DEPARTMENT,
            'VIEW_DEPARTMENT'   => self::VIEW_DEPARTMENT,
        ];
    }
}