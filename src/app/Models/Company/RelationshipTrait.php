<?php

namespace App\Models\Company;

use App\Models\Transaction\Transaction;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait RelationshipTrait
 *
 * Trait used to manage relationship between Company Model and other Models.
 */
trait RelationshipTrait
{
    /**
     * Get all the Companies transactions.
     */
    public function transactions(): MorphMany
    {
        return $this->morphMany(Transaction::class, 'issuer');
    }
}
