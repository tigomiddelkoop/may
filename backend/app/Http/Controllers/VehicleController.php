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
        $vehicles = Vehicle::with(['engineType', 'vehicleType', 'defaultFuelType'])
            ->orderBy('created_at')
            ->get();

        return new GetResponse($vehicles);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $vehicle = Vehicle::create([
            // required
            'make' => $validated['make'],
            'model' => $validated['model'],
            'initial_kilometers' => $validated['initial_kilometers'],
            'license_plate' => $validated['license_plate'],
            'license_plate_country' => $validated['license_plate_country'],

            // nullable
            'vin_number' => $validated['vin_number'] ?? null,
            'note' => $validated['note'] ?? null,

            // filled by auth
            'added_by' => 1,

            // relations
            'default_fuel_id' => $validated['default_fuel_id'],
            'engine_type_id' => $validated['engine_type_id'],
            'vehicle_type_id' => $validated['vehicle_type_id'],
        ]);

        return new StoreResponse($vehicle);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $license_plate)
    {
        $vehicle = Vehicle::with(['engineType', 'vehicleType', 'defaultFuel'])
            ->where('license_plate', $license_plate)
            ->first();

        return new GetResponse($vehicle);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $license_plate)
    {
        $validated = $request->validated();

        $vehicle = Vehicle::where('license_plate', $license_plate)->first();
        $updated = $vehicle->update([
            'make' => $validated['make'] ?? $vehicle->make,
            'model' => $validated['model'] ?? $vehicle->model,
            'license_plate' => $validated['license_plate'] ?? $vehicle->license_plate,
            'license_plate_country' => $validated['license_plate_country'] ?? $vehicle->license_plate_country,
            'vin_number' => $validated['vin_number'] ?? $vehicle->vin_number,
            'initial_kilometers' => $validated['initial_kilometers'] ?? $vehicle->initial_kilometers,
            'note' => $validated['note'] ?? $vehicle->note,
            'vehicle_type_id' => $validated['vehicle_type_id'] ?? $vehicle->vehicle_type_id,
            'engine_type_id' => $validated['engine_type_id'] ?? $vehicle->engine_type_id,
            'default_fuel_id' => $validated['default_fuel_id'] ?? $vehicle->default_fuel_id,
        ]);

        if (! $updated) {
            return new ErrorResponse('An error has occurred when updating the vehicle');
        }

        return new UpdateResponse($vehicle);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $license_plate)
    {
        $vehicle = Vehicle::where('license_plate', $license_plate)->first();
        $destroyed = $vehicle->delete();

        if (! $destroyed) {
            return new ErrorResponse('Something went wrong deleting the vehicle');
        }

        return new DestroyResponse();
    }
}
