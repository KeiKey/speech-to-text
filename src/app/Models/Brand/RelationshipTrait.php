<?php

namespace App\Models\Brand;

use App\Models\Vehicle\Vehicle;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * @property Collection vehicles
 */
trait RelationshipTrait
{
    /**
     * Return the Vehicles that belong to the Brand.
     *
     * @return HasMany
     */
    public function vehicles(): HasMany
    {
        return $this->hasMany(Vehicle::class);
    }
}
