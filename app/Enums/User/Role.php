<?php

namespace App\Enums\User;

enum Role: int
{
    case Admin = 1;
    case Teacher = 2;
    case Student = 3;
}
