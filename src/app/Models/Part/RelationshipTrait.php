<?php

namespace App\Models\Part;

use App\Models\Vehicle\Vehicle;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

trait RelationshipTrait
{
    /**
     * Return the Vehicle that have the Part.
     *
     * @return BelongsToMany
     */
    public function vehicles(): BelongsToMany
    {
        return $this->belongsToMany(Vehicle::class)->withTimestamps();
    }
}
