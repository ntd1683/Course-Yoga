<?php declare(strict_types=1);

namespace App\Enums;

use BenSampo\Enum\Enum;

final class ObjectTypeEnum extends Enum
{
    public const COURSE = 0;
    public const LESSON = 1;
    public const BLOG = 2;

    public static function getArrayView(): array
    {
        return [
            trans('Course') => self::COURSE,
            trans('Lesson') => self::LESSON,
            trans('Blog') => self::BLOG,
        ];
    }

    public static function getKeyByValue($value): string
    {
        return array_search($value, self::getArrayView(), true);
    }
}
