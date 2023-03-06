<?php

namespace App\Providers;

use App\Models\Brand\Brand;
use App\Models\Vehicle\Vehicle;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\View;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(): void
    {
        View::composer('partials.filters', function ($view) {
            $filtersAreNotEmpty = !empty(array_filter(request()->all(), fn ($value) => !empty($value)));

            $view->with([
                'sizes'    => Vehicle::query()->select('size')->filter(request()->all())->distinct()->pluck('size'),
                'models'   => Vehicle::query()->select('model')->filter(request()->all())->distinct()->pluck('model'),
                'years'    => Vehicle::query()->select('year')->filter(request()->all())->distinct()->pluck('year'),
                'brands'   => Brand::query()
                    ->distinct()
                    ->when($filtersAreNotEmpty, function ($query) {
                        $query->whereHas('vehicles', fn($q) => $q->whereIn('id', Vehicle::query()->filter(request()->all())->pluck('id')));
                    })
                    ->pluck('name', 'id'), Vehicle::query()->filter(request()->all())->pluck('id'),
            ]);
        });
    }
}
