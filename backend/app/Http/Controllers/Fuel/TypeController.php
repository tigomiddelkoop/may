<?php

namespace App\Http\Controllers\Fuel;

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
        return FuelType::orderBy('id')->get();
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

        if (!$saved) {
            abort(502, 'Something went wrong saving the fuel type');
        }

        return $fuelType->refresh();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return FuelType::find($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validated = $request->validated();

        $updated = FuelType::find($id)->update($validated);

        if (!$updated) {
            abort(502, 'Something went wrong updating the fuel type');
        }

        return FuelType::find($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroyed = FuelType::destroy($id);

        if (!$destroyed) {
            abort(502, 'Something went wrong deleting the fuel type');
        }

        return ['code' => 'MAY-2000', 'message' => 'Fuel Type has been deleted'];
    }
}
