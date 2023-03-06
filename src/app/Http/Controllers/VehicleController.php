<?php

namespace App\Http\Controllers;

use App\Http\Requests\FilterRequest;
use App\Models\Vehicle\Vehicle;
use Illuminate\Contracts\View\View;

class VehicleController extends Controller
{
    /**
     * Display a listing of the Vehicles.
     *
     * @param FilterRequest $request
     * @return View
     */
    public function index(FilterRequest $request): View
    {
        return view('vehicles.index', [
            'vehicles' => Vehicle::query()->with('brand')->filter($request->validated())->paginate(25)
        ]);
    }

    /**
     * Display the specified Vehicle.
     *
     * @param Vehicle $vehicle
     * @return View
     */
    public function show(Vehicle $vehicle): View
    {
        $vehicle->load('parts');

        return view('vehicles.show', [
            'vehicle' => $vehicle
        ]);
    }
}
