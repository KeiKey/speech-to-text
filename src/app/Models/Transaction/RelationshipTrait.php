<?php

namespace App\Models\Transaction;

use Illuminate\Database\Eloquent\Relations\MorphTo;

/**
 * Trait RelationshipTrait
 *
 * Trait used to manage relationship between Transaction Model and other Models.
 */
trait RelationshipTrait
{
    /**
     * Get the parent issuer model (individual or company).
     */
    public function issuer(): MorphTo
    {
        return $this->morphTo();
    }
}
