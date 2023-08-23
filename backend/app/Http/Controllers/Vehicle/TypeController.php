<?php

namespace App\Http\Controllers\Vehicle;

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
        return VehicleType::orderBy('id')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $vehicleType = new VehicleType();

        $vehicleType->name = $validated['name'];

        $saved = $vehicleType->save();

        if (! $saved) {
            abort(502, 'Something went wrong saving the vehicle type');
        }

        return $vehicleType->refresh();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return VehicleType::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $updated = VehicleType::find($id)->update($validated);

        if (! $updated) {
            abort(502, 'Something went wrong updating the vehicle type');
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
            abort(502, 'Something went wrong deleting the vehicle type');
        }

        return ['code' => 'MAY-2000', 'message' => 'Vehicle type has been deleted'];
    }
}
