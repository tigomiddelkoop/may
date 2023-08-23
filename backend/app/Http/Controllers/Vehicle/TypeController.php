<?php

namespace App\Http\Controllers\Vehicle;

use App\Http\Controllers\Controller;
use App\Http\Requests\VehicleType\UpdateRequest;
use App\Http\Requests\VehicleType\StoreRequest;
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

        $vehicleType->save();

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
        VehicleType::find($id)->update($validated);

        return VehicleType::find($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        return VehicleType::destroy($id);
    }
}
