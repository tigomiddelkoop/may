<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Requests\Vehicle\UpdateRequest as VehicleUpdateRequest;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class UpdateController extends Controller
{
    /**
     * Handle the incoming request.
     */
    public function __invoke(VehicleUpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $vehicle = Vehicle::find($id)->update($validated);

        // @TODO fix the assocs with relations when they change
        // $vehicle->vehicleType()->associate($validated['vehicle_type']);
        // $vehicle->engineType()->associate($validated['engine_type']);-
        // $vehicle->defaultFuelType()->associate($validated['fuel_type']);

        return Vehicle::find($id);
    }
}
