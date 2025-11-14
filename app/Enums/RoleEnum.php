<?php

namespace App\Enums;

enum RoleEnum: string
{
    case ADMIN = 'admin';
    case CREATOR = 'creator';
    case MEMBER = 'member';
}
