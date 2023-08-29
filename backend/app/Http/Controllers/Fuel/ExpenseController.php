<?php

namespace App\Http\Controllers\Fuel;

use App\Classes\DestroyResponse;
use App\Classes\ErrorResponse;
use App\Classes\GetResponse;
use App\Classes\StoreResponse;
use App\Classes\UpdateResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Fuel\Expense\UpdateRequest;
use App\Http\Requests\Fuel\Expense\StoreRequest;
use App\Models\FuelExpense;
use App\Models\Vehicle;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $fuelExpenses = FuelExpense::orderBy('id')->get();

        return new GetResponse($fuelExpenses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $fuelExpense = new FuelExpense();
        $vehicle = Vehicle::find($validated['vehicle_id']);

        $fuelExpense->fuel_quantity = $validated['fuel_quantity'];
        $fuelExpense->fuel_price = $validated['fuel_price'];
        $fuelExpense->odo_reading = $validated['odo_reading'];
        $fuelExpense->filled_up = $validated['filled_up'];

        $fuelExpense->total_price = $this->calculatePrice(fuelQuantity: $validated['fuel_quantity'], fuelPrice: $validated['fuel_price']);

        if (isset($validated['fuel_id'])) {
            $fuelExpense->fuel()->associate($validated['fuel_id']);
        } else {
            $fuelExpense->fuel()->associate($vehicle->default_fuel_id);
        }

        $fuelExpense->vehicle()->associate($validated['vehicle_id']);

        if (isset($validated['location_id'])) {
            $fuelExpense->location()->associate($validated['location_id']);
        }

        if (isset($validated['note'])) {
            $fuelExpense->note = $validated['note'];
        }

        $saved = $fuelExpense->saveOrFail();

        if (!$saved) {
            return new ErrorResponse('An error has occurred when storing the fuel expense');
        }

        return new StoreResponse($fuelExpense->refresh());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $fuelExpense = FuelExpense::with(['fuel', 'vehicle', 'location'])->find($id);

        return new GetResponse($fuelExpense);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $fuelExpense = FuelExpense::find($id);
        $vehicle = Vehicle::find($validated['vehicle_id']);

        $recalculatePrice = false;

        // fuel_quantity
        if (isset($validated['fuel_quantity']) && $fuelExpense->fuel_quantity != $validated['fuel_quantity']) {
            $fuelExpense->fuel_quantity = $validated['fuel_quantity'];
            $recalculatePrice = true;
        }

        // fuel_price
        if (isset($validated['fuel_price']) && $fuelExpense->fuel_price != $validated['fuel_price']) {
            $fuelExpense->fuel_price = $validated['fuel_price'];
            $recalculatePrice = true;
        }

        // total_price
        if ($recalculatePrice) {
            $fuelExpense->total_price = $this->calculatePrice(fuelQuantity: $fuelExpense->fuel_quantity, fuelPrice: $fuelExpense->fuel_price);
        }

        // odo_reading
        if (isset($validated['odo_reading']) && $fuelExpense->odo_reading != $validated['odo_reading']) {
            $fuelExpense->odo_reading = $validated['odo_reading'];
        }

        // filled_up
        if (isset($validated['filled_up']) && $fuelExpense->filled_up != $validated['filled_up']) {
            $fuelExpense->filled_up = $validated['filled_up'];
        }

        // fuel_id
        if (isset($validated['fuel_id']) && $fuelExpense->fuel_id != $validated['fuel_id']) {
            $fuelExpense->fuel()->associate($validated['fuel_id']);
        } else {
            $fuelExpense->fuel()->associate($vehicle->default_fuel_id);
        }

        // vehicle_id
        if (isset($validated['vehicle_id']) && $fuelExpense->vehicle_id != $validated['vehicle_id']) {
            $fuelExpense->vehicle()->associate($validated['vehicle_id']);
        }

        // location_id
        if (isset($validated['location_id']) && $fuelExpense->location_id != $validated['location_id']) {
            $fuelExpense->location()->associate($validated['location_id']);
        }

        // note
        if (isset($validated['note']) && $fuelExpense->note != $validated['note']) {
            $fuelExpense = $validated['note'];
        }

        $updated = $fuelExpense->update();
        if (!$updated) {
            return new ErrorResponse('An error has occurred when updating the fuel expense');
        }

        return new UpdateResponse(FuelExpense::find($id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public
    function destroy(string $id)
    {
        $destroyed = FuelExpense::destroy($id);

        if (!$destroyed) {
            return new ErrorResponse('Something went wrong deleting the fuel type');
        }

        return new DestroyResponse();
    }

    private
    function calculatePrice($fuelQuantity, $fuelPrice): float
    {
        $totalPrice = bcmul($fuelQuantity, $fuelPrice, 3);

        return round($totalPrice, 2);
    }
}
