<?php

namespace App\Enums;

class ImportType extends Enum
{
    public const VEHICLE = 'vehicle';
    public const PART = 'part';

    public static function default(): string
    {
        return self::VEHICLE;
    }
}
