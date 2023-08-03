<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserLevelEnum extends Enum
{
    public const USER = 0;
    public const LECTURER = 1;
    public const ADMIN = 2;

    public static function getArrayView(): array
    {
        return [
            'User' => self::USER,
            'Lecturer' => self::LECTURER,
            'Admin' => self::ADMIN,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}
