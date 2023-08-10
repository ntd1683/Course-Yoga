<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class TypeOrderEnum extends Enum
{
    public const OTHER = 0;
    public const VNPAY = 1;

    public static function getArrayView(): array
    {
        return [
            'Other' => self::OTHER,
            'Vnpay' => self::VNPAY,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}
