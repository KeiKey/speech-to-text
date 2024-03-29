<?php

namespace App\Enums;

use ReflectionClass;

/**
 * Class Enum.
 */
class Enum
{
    /**
     * Return an array with all declared constants.
     *
     * @return array
     */
    public static function toArray() : array
    {
        return (new ReflectionClass(static::class))->getConstants();
    }

    /**
     * Return a string with all declared constants.
     *
     * @param string $glue
     * @return string
     */
    public static function toString(string $glue = ',') : string
    {
        return implode($glue, self::toArray());
    }
}
