<?php

namespace App\Models\Vehicle;

use App\Models\Brand\Brand;
use App\Models\Part\Part;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * @property Brand brand
 * @property Collection parts
 */
trait RelationshipTrait
{
    /**
     * Return the Brand that has the Vehicle.
     *
     * @return BelongsTo
     */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }

    /**
     * Return the Parts that belong to the Vehicle.
     *
     * @return BelongsToMany
     */
    public function parts(): BelongsToMany
    {
        return $this->belongsToMany(Part::class)->withTimestamps();
    }
}
