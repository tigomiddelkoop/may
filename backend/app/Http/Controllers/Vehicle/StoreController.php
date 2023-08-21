<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vehicle\StoreRequest as VehicleStoreRequest;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class StoreController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(VehicleStoreRequest $request)
    {
        $validated = $request->validated();
        $vehicle = new Vehicle();

        $vehicle->make = $validated['make'];
        $vehicle->model = $validated['model'];

        $vehicle->initial_kilometers = $validated['initial_kilometers'];
        $vehicle->vin_number = $validated['vin_number'];

        $vehicle->license_plate = $validated['license_plate'];
        $vehicle->license_plate_country = $validated['license_plate_country'];

        $vehicle->vehicleType()->associate($validated['vehicle_type']);
        $vehicle->engineType()->associate($validated['engine_type']);
        $vehicle->defaultFuelType()->associate($validated['fuel_type']);

        // @TODO Switch to the user model for login
        $vehicle->added_by = 1;

        $savedVehicle = $vehicle->save();

        return $savedVehicle;
    }
}
