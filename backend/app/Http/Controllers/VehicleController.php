<?php

namespace App\Http\Controllers;

use App\Classes\DestroyResponse;
use App\Classes\ErrorResponse;
use App\Classes\GetResponse;
use App\Classes\StoreResponse;
use App\Classes\UpdateResponse;
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
        $vehicles = Vehicle::with(['engineType', 'vehicleType', 'defaultFuelType'])->orderBy('id')->get();

        return new GetResponse($vehicles);
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

        if (isset($validated['vin_number']) && $vehicle->vin_number != $validated['vin_number']) {
            $vehicle->vin_number = $validated['vin_number'];
        }

        $vehicle->license_plate = $validated['license_plate'];
        $vehicle->license_plate_country = $validated['license_plate_country'];

        if (isset($validated['note']) && $vehicle->note != $validated['note']) {
            $vehicle->note = $validated['note'];
        }

        $vehicle->vehicleType()->associate($validated['vehicle_type_id']);
        $vehicle->engineType()->associate($validated['engine_type_id']);
        $vehicle->defaultFuelType()->associate($validated['default_fuel_type_id']);

        // @TODO Switch to the user model for login
        $vehicle->added_by = 1;

        $saved = $vehicle->save();

        if (! $saved) {
            return new ErrorResponse();
        }

        return new StoreResponse($vehicle->refresh());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehicle = Vehicle::with(['engineType', 'vehicleType', 'defaultFuelType'])->find($id);

        return new GetResponse($vehicle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $vehicle = Vehicle::find($id);

        if (isset($validated['model']) && $vehicle->model != $validated['model']) {
            $vehicle->model = $validated['model'];
        }

        if (isset($validated['license_plate']) && $vehicle->license_plate != $validated['license_plate']) {
            $vehicle->license_plate = $validated['license_plate'];
        }

        if (isset($validated['license_plate_country']) && $vehicle->license_plate_country != $validated['license_plate_country']) {
            $vehicle->license_plate_country = $validated['license_plate_country'];
        }

        if (isset($validated['vin_number']) && $vehicle->vin_number != $validated['vin_number']) {
            $vehicle->vin_number = $validated['vin_number'];
        }

        if (isset($validated['initial_kilometers']) && $vehicle->initial_kilometers != $validated['initial_kilometers']) {
            $vehicle->initial_kilometers = $validated['initial_kilometers'];
        }

        if (isset($validated['note']) && $vehicle->note != $validated['note']) {
            $vehicle->note = $validated['note'];
        }

        if (isset($validated['vehicle_type_id']) && $vehicle->vehicle_type_id != $validated['vehicle_type_id']) {
            $vehicle->vehicleType()->associate($validated['vehicle_type_id']);
        }

        if (isset($validated['engine_type_id']) && $vehicle->engine_type_id != $validated['engine_type_id']) {
            $vehicle->engineType()->associate($validated['engine_type_id']);
        }

        if (isset($validated['default_fuel_type_id']) && $vehicle->default_fuel_type_id != $validated['default_fuel_type_id']) {
            $vehicle->defaultFuelType()->associate($validated['default_fuel_type_id']);
        }

        $updated = $vehicle->update();
        if (! $updated) {
            return new ErrorResponse();
        }

        return new UpdateResponse(Vehicle::find($id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroyed = Vehicle::destroy($id);

        if (! $destroyed) {
            return new ErrorResponse();
        }

        return new DestroyResponse();
    }
}
