<?php

namespace App\Models\Import;

use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

/**
 * @property User uploader
 */
trait RelationshipTrait
{
    /**
     * Returns the User that has the Import
     *
     * @return BelongsTo
     */
    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }
}
