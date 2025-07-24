<?php

namespace App\Enums;

enum UserProfessionEnums: string
{
 
    case EMPLOYEE           = 'clerk';
    case WORKER             = 'labourers';
    case TRAINEE            = 'trainee';
    case OFFICIAL           = 'public_servant';
    case FREELANCER         = 'freelancer';
    case MANAGING_PARTNER   = 'managing_partner';
    case HOUSEWIFE          = 'housewife';
    case HOUSEMAN           = 'hausmann';
    case EXECUTIVE          = 'senior_employee';
    case UNEMPLOYED         = 'without_employment';
    case PENSIONER          = 'retired_person';
    case RETIREE            = 'retired_pensioner';
    case PUPIL              = 'pupils';
    case OTHER              = 'other_private_individuals';
    case SELF_EMPLOYED      = 'other_selfemployed';
    case STUDENT            = 'student_student';

    public function toString(): string
    {
        return match ($this) {
            self::EMPLOYEE    => 'clerk',
            self::WORKER      => 'labourers',
            self::TRAINEE     => 'trainee',
            self::OFFICIAL    => 'public servant',
            self::FREELANCER  => 'freelancer',
            self::MANAGING_PARTNER => 'managing partner',
            self::HOUSEWIFE   => 'housewife',
            self::HOUSEMAN    => 'hausmann',
            self::EXECUTIVE   => 'senior employee',
            self::UNEMPLOYED  => 'without employment',
            self::PENSIONER   => 'retired person',
            self::RETIREE     => 'retired pensioner',
            self::PUPIL       => 'pupils',
            self::OTHER       => 'other private individuals',
            self::SELF_EMPLOYED => 'other selfemployed',
            self::STUDENT     => 'student student',
        };
    }
}
