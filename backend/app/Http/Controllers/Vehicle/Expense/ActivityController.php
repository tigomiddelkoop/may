<?php

namespace App\Http\Controllers\Vehicle\Expense;

use App\Classes\DestroyResponse;
use App\Classes\ErrorResponse;
use App\Classes\GetResponse;
use App\Http\Controllers\Controller;
use App\Models\ActivityExpense;
use App\Models\Vehicle;
use Illuminate\Http\Request;

class ActivityController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(string $license_plate)
    {
        $activityExpenses = ActivityExpense::whereRelation('vehicle', 'license_plate', '=', $license_plate)->orderByDesc('expense_time')->get();

        return new GetResponse($activityExpenses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, string $license_plate)
    {
        $validated = $request->validated();
        $activityExpense = new ActivityExpense();
        $vehicle = Vehicle::where('license_plate', $license_plate)->first();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $license_plate, string $id)
    {
        $activityExpense = ActivityExpense::whereRelation('vehicle', 'license_plate', '=', $license_plate)->with(['vehicle', 'location'])->find($id);

        return new GetResponse($activityExpense);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $license_plate, string $id)
    {
        $activityExpense = ActivityExpense::whereRelation('vehicle', 'license_plate', '=', $license_plate)->find($id);
        $destroyed = $activityExpense->delete();

        if (! $destroyed) {
            return new ErrorResponse('Something went wrong deleting the activity expense');
        }

        return new DestroyResponse();
    }
}
