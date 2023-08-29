<?php

namespace App\Http\Controllers\Vehicle;

use App\Classes\GetResponse;
use App\Http\Controllers\Controller;
use App\Models\FuelExpense;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class OverviewController extends Controller
{
    public function index()
    {
        return 'DEVICE OVERVIEW';
    }

    public function show(string $license_plate)
    {
        $vehicle = Vehicle::with(['fuelExpenses'])->where('license_plate', $license_plate)->first();

        // add calculations for each category in activity expenses and also add the same calculation for the fuelexpenses. USING DB RAW as eloquent can not do this, reading the documentation
        $fuelExpenses = FuelExpense::

        $vehicle->test = "test";

        return new GetResponse($vehicle);
    }
}
