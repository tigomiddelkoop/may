<?php

namespace App\Http\Controllers;

use App\Classes\DestroyResponse;
use App\Classes\ErrorResponse;
use App\Classes\GetResponse;
use App\Classes\StoreResponse;
use App\Classes\UpdateResponse;
use App\Http\Requests\Fuel\StoreRequest;
use App\Http\Requests\Fuel\UpdateRequest;
use App\Models\Fuel;

class FuelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fuels = Fuel::orderBy('created_at')->get();

        return new GetResponse($fuels);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $fuel = Fuel::create([
            // required
            'name' => $validated['name'],

            // nullable
            'description' => $validated['description'] ?? null,

            // relations
            'fuel_type_id' => $validated['fuel_type_id'],
        ]);

        return new StoreResponse($fuel);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fuel = Fuel::where('id', $id)
            ->with(['fuelType'])
            ->first();

        return new GetResponse($fuel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validated = $request->validated();

        $fuel = Fuel::find($id);
        $updated = $fuel->update([
            'name' => $validated['name'] ?? $fuel->name,
            'description' => $validated['description'] ?? $fuel->description,
            'fuel_type_id' => $validated['fuel_type_id'] ?? $fuel->fuel_type_id,
        ]);

        if (! $updated) {
            return new ErrorResponse('An error has occurred when updating the fuel');
        }

        return new UpdateResponse($fuel);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroyed = Fuel::destroy($id);

        if (! $destroyed) {
            return new ErrorResponse('Something went wrong deleting the fuel');
        }

        return new DestroyResponse();
    }
}
