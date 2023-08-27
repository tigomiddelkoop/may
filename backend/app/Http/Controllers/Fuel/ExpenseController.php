<?php

namespace App\Http\Controllers\Fuel;

use App\Classes\DestroyResponse;
use App\Classes\ErrorResponse;
use App\Classes\GetResponse;
use App\Classes\StoreResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Activity\Expense\UpdateRequest;
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

        $fuelExpense->total_price = $validated['fuel_quantity'] * $validated['fuel_price'];

        if (isset($validated['note'])) {
            $fuelExpense = $validated['note'];
        }

        if (isset($validated['fuel_id'])) {
            $fuelExpense->fuel()->associate($validated['fuel_id']);
        } else {
            $fuelExpense->fuel()->associate($vehicle->default_fuel_id);
        }

        $fuelExpense->vehicle()->associate($validated['vehicle_id']);

        if (isset($validated['location_id'])) {
            $fuelExpense->location()->associate($validated['location_id']);
        }

        $saved = $fuelExpense->saveOrFail();

        if (! $saved) {
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
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroyed = FuelExpense::destroy($id);

        if (! $destroyed) {
            return new ErrorResponse('Something went wrong deleting the fuel type');
        }

        return new DestroyResponse();
    }
}
