<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

/**
 * Trait HasUUID
 */
trait HasUUID
{
    /**
     * Boot function: if the model has the trait, the UUID is automatically
     * generated and assigned to the model.
     *
     * @return void
     */
    public static function bootHasUUID(): void
    {
        static::creating(function ($model) {
            if (empty($model->uuid)) {
                $model->uuid = static::generateUUID();
            }
        });
    }

    /**
     * Generate new UUID
     *
     * @return string
     */
    public static function generateUUID(): string
    {
        return Uuid::uuid4()->toString();
    }

    /**
     * Scope function to filter by UUID
     *
     * @param Builder $query
     * @param string $uuid
     *
     * @return Builder
     */
    public function scopeByUUID(Builder $query, string $uuid): Builder
    {
        return $query->where('uuid', $uuid);
    }
}
