<?php

namespace App\Models\User;

use App\Models\Import\Import;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property Collection imports
 */
trait RelationshipTrait
{
    /**
     * Return the Imports that belong to the User.
     *
     * @return HasMany
     */
    public function imports(): HasMany
    {
        return $this->hasMany(Import::class, 'uploader_id');
    }
}
