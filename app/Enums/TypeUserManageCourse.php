<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

/**
 * @method static static OptionOne()
 * @method static static OptionTwo()
 * @method static static OptionThree()
 */
final class TypeUserManageCourse extends Enum
{
    public const COLLABORATOR = 0;
    public const AUTHOR = 1;

    public static function getArrayView(): array
    {
        return [
            trans('Collaborator') => self::COLLABORATOR,
            trans('Author') => self::AUTHOR,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}
