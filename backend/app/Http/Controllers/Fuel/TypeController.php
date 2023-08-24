<?php

namespace App\Http\Controllers\Fuel;

use App\Classes\DestroyResponse;
use App\Classes\ErrorResponse;
use App\Classes\GetResponse;
use App\Classes\StoreResponse;
use App\Classes\UpdateResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\StoreRequest;
use App\Http\Requests\Categories\UpdateRequest;
use App\Models\FuelType;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fueltypes = FuelType::orderBy('id')->get();

        return new GetResponse($fueltypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $fuelType = new FuelType();

        $fuelType->name = $validated['name'];

        $saved = $fuelType->save();

        if (! $saved) {
            return new ErrorResponse();
        }

        return new StoreResponse($fuelType->refresh());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fueltype = FuelType::find($id);

        return new GetResponse($fueltype);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validated = $request->validated();

        $updated = FuelType::find($id)->update($validated);

        if (! $updated) {
            return new ErrorResponse();
        }

        return new UpdateResponse(FuelType::find($id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroyed = FuelType::destroy($id);

        if (! $destroyed) {
            return new ErrorResponse();
        }

        return new DestroyResponse();
    }
}
