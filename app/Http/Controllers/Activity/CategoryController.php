<?php

namespace App\Http\Controllers\Activity;

use App\Classes\DestroyResponse;
use App\Classes\ErrorResponse;
use App\Classes\GetResponse;
use App\Classes\StoreResponse;
use App\Classes\UpdateResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\StoreRequest;
use App\Http\Requests\Categories\UpdateRequest;
use App\Models\ActivityCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $activityCategories = ActivityCategory::orderBy('id')->get();

        return new GetResponse($activityCategories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $engineType = new ActivityCategory();

        $engineType->name = $validated['name'];

        $saved = $engineType->saveOrFail();

        if (! $saved) {
            return new ErrorResponse('An error has occurred when storing the activity category');
        }

        return new StoreResponse($engineType->refresh());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $activityCategory = ActivityCategory::find($id);

        return new GetResponse($activityCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $engineType = ActivityCategory::find($id);

        // name
        if (isset($validated['name']) && $engineType->name != $validated['name']) {
            $engineType->name = $validated['name'];
        }

        $updated = $engineType->update();
        if (! $updated) {
            return new ErrorResponse('An error has occurred when updating the activity category');
        }

        return new UpdateResponse(ActivityCategory::find($id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroyed = ActivityCategory::destroy($id);

        if (! $destroyed) {
            return new ErrorResponse('Something went wrong deleting the activity category');
        }

        return new DestroyResponse();
    }
}
