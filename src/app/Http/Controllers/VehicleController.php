<?php

namespace App\Http\Controllers;

use App\Models\Vehicle\Vehicle;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        //
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
