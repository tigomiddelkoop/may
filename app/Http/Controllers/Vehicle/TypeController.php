<?php

namespace App\Http\Controllers\Vehicle;

use App\Classes\DestroyResponse;
use App\Classes\ErrorResponse;
use App\Classes\GetResponse;
use App\Classes\StoreResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\StoreRequest;
use App\Http\Requests\Categories\UpdateRequest;
use App\Models\VehicleType;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $vehicleTypes = VehicleType::orderBy('id')->get();

        return new GetResponse($vehicleTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $vehicleType = new VehicleType();

        $vehicleType->name = $validated['name'];

        $saved = $vehicleType->saveOrFail();

        if (! $saved) {
            return new ErrorResponse('An error has occurred when storing the vehicle type');
        }

        return new StoreResponse($vehicleType->refresh());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $vehicleType = VehicleType::find($id);

        return new GetResponse($vehicleType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $vehicleType = VehicleType::find($id);

        // name
        if (isset($validated['name']) && $vehicleType->name != $validated['name']) {
            $vehicleType->name = $validated['name'];
        }

        $updated = $vehicleType->update();
        if (! $updated) {
            return new ErrorResponse('An error has occurred when updating the vehicle type');
        }

        return VehicleType::find($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroyed = VehicleType::destroy($id);

        if (! $destroyed) {
            return new ErrorResponse();
        }

        return new DestroyResponse();
    }
}
