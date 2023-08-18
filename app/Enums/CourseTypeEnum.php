<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class CourseTypeEnum extends Enum
{
    public const FREE = 0;
    public const PREMIUM = 1;

    public static function getArrayView(): array
    {
        return [
            trans('Free') => self::FREE,
            trans('Premium') => self::PREMIUM,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}
