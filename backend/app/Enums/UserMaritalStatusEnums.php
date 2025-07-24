<?php

namespace App\Enums;

enum UserMaritalStatusEnums: string
{
 
    case MARRIED    = 'married';
    case DIVORCED   = 'divorced';
    case SEPARATED  = 'separated';
    case SINGLE     = 'single';
    case WIDOWED    = 'widowed';

    public function toString(): string
    {
        return match ($this) {
            self::MARRIED    => 'married',
            self::DIVORCED   => 'divorced',
            self::SEPARATED  => 'separated',
            self::SINGLE     => 'single',
            self::WIDOWED    => 'widowed',
        };
    }
}
