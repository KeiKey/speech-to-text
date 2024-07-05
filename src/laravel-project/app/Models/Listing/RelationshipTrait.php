<?php

namespace App\Models\Listing;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * Trait RelationshipTrait
 *
 * Trait used to manage relationship between Listing Model and other Models.
 */
trait RelationshipTrait
{
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'creator_id');
    }

    public function inspector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'inspector_id');
    }
}
