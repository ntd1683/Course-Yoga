<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class OrderStatusEnum extends Enum
{
    public const WAITING = 0;
    public const PAID = 1;

    public static function getArrayView(): array
    {
        return [
            trans('Waiting') => self::WAITING,
            trans('Paid') => self::PAID,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}
