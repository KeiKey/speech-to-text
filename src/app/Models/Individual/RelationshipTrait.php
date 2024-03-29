<?php

namespace App\Models\Individual;

use App\Models\Transaction\Transaction;
use Illuminate\Database\Eloquent\Relations\MorphMany;

/**
 * Trait RelationshipTrait
 *
 * Trait used to manage relationship between Individual Model and other Models.
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
