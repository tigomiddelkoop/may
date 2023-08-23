<?php

namespace App\Http\Controllers;

use App\Http\Requests\Vehicle\StoreRequest;
use App\Http\Requests\Vehicle\UpdateRequest;
use App\Models\Vehicle;

class VehicleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Vehicle::with(['engineType', 'vehicleType', 'defaultFuelType'])->orderBy('id')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
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
        $vehicle->defaultFuelType()->associate($validated['default_fuel_type']);

        // @TODO Switch to the user model for login
        $vehicle->added_by = 1;

        $vehicle->save();

        return $vehicle->refresh();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Vehicle::with(['engineType', 'vehicleType', 'defaultFuelType'])->find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $vehicle = Vehicle::find($id)->update($validated);

        // @TODO fix the assocs with relations when they change
        // $vehicle->vehicleType()->associate($validated['vehicle_type']);
        // $vehicle->engineType()->associate($validated['engine_type']);-
        // $vehicle->defaultFuelType()->associate($validated['fuel_type']);

        return Vehicle::find($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return Vehicle::destroy($id);
    }
}
