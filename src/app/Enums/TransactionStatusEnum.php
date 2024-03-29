<?php

namespace App\Enums;

class TransactionStatusEnum extends Enum
{
    const PENDING = 'Pending';
    const PROCESSED = 'Processed';
    const FAILED = 'Failed';
    /**
     * Return the default value.
     *
     * @return string
     */
    public static function default(): string
    {
        return self::PENDING;
    }
}
