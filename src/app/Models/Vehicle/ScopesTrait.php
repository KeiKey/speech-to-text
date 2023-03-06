<?php

namespace App\Models\Vehicle;

use Illuminate\Database\Eloquent\Builder;

trait ScopesTrait
{
    public function scopeFilter(Builder $builder, array $filterData = []): Builder
    {
        return $builder
            ->when(!empty($filterData['brand']), fn (Builder $query) => $query->whereRelation('brand', 'id', $filterData['brand']))
            ->when(!empty($filterData['size']), fn (Builder $query) => $query->where('size', $filterData['size']))
            ->when(!empty($filterData['model']), fn (Builder $query) => $query->where('model', $filterData['model']))
            ->when(!empty($filterData['year']), fn (Builder $query) => $query->where('year', $filterData['year']));
    }
}
