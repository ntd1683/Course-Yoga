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
            trans('User') => self::USER,
            trans('UserVip') => self::USERVIP,
            trans('Lecturer') => self::LECTURER,
            trans('Admin') => self::ADMIN,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}
