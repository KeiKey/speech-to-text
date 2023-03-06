<?php

namespace App\Enums;

class ImportStatus extends Enum
{
    public const TO_BE_PROCESSED = 'to be processed';
    public const PROCESSING = 'processing';
    public const PROCESSED = 'processed';
    public const FAILED = 'failed';

    public static function default(): string
    {
        return self::TO_BE_PROCESSED;
    }
}
