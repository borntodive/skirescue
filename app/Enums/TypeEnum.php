<?php

namespace App\Enums;

enum TypeEnum: string
{
    case ADMIN = 'admin';
    case RESCUER = 'rescuer';
    case OPSCENTRAL = 'opscentral';
}
