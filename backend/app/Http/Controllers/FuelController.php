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
        $fuels = Fuel::orderBy('id')->get();

        return new GetResponse($fuels);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $fuel = new Fuel();

        $fuel->name = $validated['name'];

        if (isset($validated['description'])) {
            $fuel->description = $validated['description'];
        }

        $fuel->fuelType()->associate($validated['fuel_type_id']);

        $saved = $fuel->saveOrFail();

        if (! $saved) {
            return new ErrorResponse('An error has occurred when storing the fuel');
        }

        return new StoreResponse($fuel->refresh());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fuel = Fuel::with(['fuelType'])->where('id', $id)->first();

        return new GetResponse($fuel);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $fuel = Fuel::find($id);

        if (isset($validated['name']) && $fuel->name != $validated['name']) {
            $fuel->name = $validated['name'];
        }

        if (isset($validated['description']) && $fuel->description != $validated['description']) {
            $fuel->description = $validated['description'];
        }

        if (isset($validated['fuel_type_id']) && $fuel->fuel_type_id != $validated['fuel_type_id']) {
            $fuel->fuelType()->associate($validated['fuel_type_id']);
        }

        $updated = $fuel->update();
        if (! $updated) {
            return new ErrorResponse('An error has occurred when updating the fuel');
        }

        return new UpdateResponse(Fuel::find($id));
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
