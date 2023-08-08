<?php

namespace App\Enums;

use BenSampo\Enum\Enum;

final class UserLevelEnum extends Enum
{
    public const USER = 0;
    public const USERVIP = 1;
    public const LECTURER = 2;
    public const ADMIN = 3;

    public static function getArrayView(): array
    {
        return [
            'User' => self::USER,
            'UserVip' => self::USERVIP,
            'Lecturer' => self::LECTURER,
            'Admin' => self::ADMIN,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}
