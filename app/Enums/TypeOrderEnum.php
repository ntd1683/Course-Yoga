<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TypeOrderEnum extends Enum
{
    public const OTHER = 0;
    public const VNPAY = 1;
    public const MOMO = 2;

    public static function getArrayView(): array
    {
        return [
            trans('Other') => self::OTHER,
            trans('Vnpay') => self::VNPAY,
            trans('Momo') => self::MOMO,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}
