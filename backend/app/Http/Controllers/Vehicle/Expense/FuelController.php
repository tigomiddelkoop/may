<?php

namespace App\Http\Controllers\Vehicle\Expense;

use App\Classes\DestroyResponse;
use App\Classes\ErrorResponse;
use App\Classes\GetResponse;
use App\Classes\StoreResponse;
use App\Classes\UpdateResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Fuel\Expense\StoreRequest;
use App\Http\Requests\Fuel\Expense\UpdateRequest;
use App\Models\FuelExpense;
use App\Models\Vehicle;
use Carbon\Carbon;

class FuelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $license_plate)
    {
        $fuelExpenses = FuelExpense::whereRelation('vehicle', 'license_plate', '=', $license_plate)->orderByDesc('expense_time')->get();

        return new GetResponse($fuelExpenses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request, string $license_plate)
    {
        $validated = $request->validated();
        $fuelExpense = new FuelExpense();
        $vehicle = Vehicle::where('license_plate', $license_plate)->first();

        $fuelExpense->fuel_quantity = $validated['fuel_quantity'];
        $fuelExpense->fuel_price = $validated['fuel_price'];
        $fuelExpense->odo_reading = $validated['odo_reading'];
        $fuelExpense->filled_up = $validated['filled_up'];

        $fuelExpense->expense_time = Carbon::parse($validated['expense_time']);

        $fuelExpense->total_price = $this->calculatePrice(fuelQuantity: $validated['fuel_quantity'], fuelPrice: $validated['fuel_price']);

        // fuel_id
        if (isset($validated['fuel_id'])) {
            $fuelExpense->fuel()->associate($validated['fuel_id']);
        } else {
            $fuelExpense->fuel()->associate($vehicle->default_fuel_id);
        }

        $fuelExpense->vehicle()->associate($vehicle->id);

        // location_id
        if (isset($validated['location_id'])) {
            $fuelExpense->location()->associate($validated['location_id']);
        }

        // note
        if (isset($validated['note'])) {
            $fuelExpense->note = $validated['note'];
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
    public function show(string $license_plate, string $id)
    {
        $fuelExpense = FuelExpense::whereRelation('vehicle', 'license_plate', '=', $license_plate)->with(['fuel', 'vehicle', 'location'])->find($id);

        return new GetResponse($fuelExpense);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $license_plate, string $id)
    {
        $validated = $request->validated();
        $fuelExpense = FuelExpense::whereRelation('vehicle', 'license_plate', '=', $license_plate)->with(['fuel', 'vehicle', 'location'])->find($id);

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
            $fuelExpense->fuel()->associate($fuelExpense->vehicle->default_fuel_id);
        }

        // location_id
        if (isset($validated['location_id']) && $fuelExpense->location_id != $validated['location_id']) {
            $fuelExpense->location()->associate($validated['location_id']);
        }

        // note
        if (isset($validated['note']) && $fuelExpense->note != $validated['note']) {
            $fuelExpense->note = $validated['note'];
        }

        // expense_time
        $expense_time_old = Carbon::parse($fuelExpense->expense_time);
        $expense_time_new = Carbon::parse($validated['expense_time']);
        if (isset($validated['expense_time']) && $expense_time_old->ne($expense_time_new)) {
            $fuelExpense->expense_time = $expense_time_new;
        }

        $updated = $fuelExpense->update();
        if (! $updated) {
            return new ErrorResponse('An error has occurred when updating the fuel expense');
        }

        return new UpdateResponse($fuelExpense->refresh());
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $license_plate, string $id)
    {
        $fuelExpense = FuelExpense::whereRelation('vehicle', 'license_plate', '=', $license_plate)->find($id);
        $destroyed = $fuelExpense->delete();

        if (! $destroyed) {
            return new ErrorResponse('Something went wrong deleting the fuel type');
        }

        return new DestroyResponse();
    }

    private function calculatePrice($fuelQuantity, $fuelPrice): float
    {
        $totalPrice = bcmul($fuelQuantity, $fuelPrice, 3);

        return round($totalPrice, 2);
    }
}
