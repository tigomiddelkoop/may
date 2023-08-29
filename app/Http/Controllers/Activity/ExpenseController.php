<?php

namespace App\Http\Controllers\Activity;

use App\Classes\DestroyResponse;
use App\Classes\ErrorResponse;
use App\Classes\GetResponse;
use App\Http\Controllers\Controller;
use App\Models\ActivityExpense;
use Illuminate\Http\Request;

class ExpenseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activityExpenses = ActivityExpense::orderBy('id')->get();

        return new GetResponse($activityExpenses);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $activityExpense = ActivityExpense::find($id);

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
    public function destroy(string $id)
    {
        $destroyed = ActivityExpense::destroy($id);

        if (! $destroyed) {
            return new ErrorResponse('Something went wrong deleting the activity expense');
        }

        return new DestroyResponse();
    }
}