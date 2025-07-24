<?php

namespace App\Enums;

enum UserSalutationEnums: string
{
    case MR          = 'MR';
    case MRS         = 'MRS';

    public function toString(): string
    {
        return match ($this) {
            self::MR            => 'Mr.',
            self::MRS           => 'Mrs.',
        };
    }
}
