<?php

namespace App\Http\Controllers\Vehicle;

use App\Classes\GetResponse;
use App\Http\Controllers\Controller;
use App\Models\Vehicle;

class OverviewController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $license_plate)
    {

        $vehicle = Vehicle::where('license_plate', $license_plate)->first();
        $fuelExpenses = $vehicle->fuelExpenses;

        // Do the price calculations using the database native plus minus functionality, for the activity expenses do the same but do it per category as well.

        return new GetResponse($vehicle);

    }
}
