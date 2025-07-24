<?php

namespace App\Enums;

enum UserTitleEnums: string
{
    case DR          = 'DR';
    case DR_DR       = 'DR_DR';
    case DR_MED      = 'DR_MED';
    case NONE        = 'NONE';
    case PROF        = 'PROF';
    case PROF_DR     = 'PROF_DR';
    case PROF_DR_DR  = 'PROF_DR_DR';
    case PROF_DR_MED = 'PROF_DR_MED';


    public function toString(): string
    {
        return match ($this) {
            self::DR => 'Dr.',
            self::DR_DR => 'Dr. Dr.',
            self::DR_MED => 'Dr. med.',
            self::NONE => 'None',
            self::PROF => 'Prof.',
            self::PROF_DR => 'Prof. Dr.',
            self::PROF_DR_DR => 'Prof. Dr. Dr.',
            self::PROF_DR_MED => 'Prof. Dr. med.',
        };
    }
}
