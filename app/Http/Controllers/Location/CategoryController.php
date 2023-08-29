<?php

namespace App\Http\Controllers\Location;

use App\Classes\DestroyResponse;
use App\Classes\ErrorResponse;
use App\Classes\GetResponse;
use App\Classes\StoreResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\StoreRequest;
use App\Http\Requests\Categories\UpdateRequest;
use App\Models\LocationCategory;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locationCategories = LocationCategory::orderBy('id')->get();

        return new GetResponse($locationCategories);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $locationCategory = new LocationCategory();

        $locationCategory->name = $validated['name'];

        $saved = $locationCategory->saveOrFail();

        if (! $saved) {
            return new ErrorResponse('An error has occurred when storing the location category');
        }

        return new StoreResponse($locationCategory->refresh());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $locationCategory = LocationCategory::find($id);

        return new GetResponse($locationCategory);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $locationCategory = LocationCategory::find($id);

        // name
        if (isset($validated['name']) && $locationCategory->name != $validated['name']) {
            $locationCategory->name = $validated['name'];
        }

        $updated = $locationCategory->update();
        if (! $updated) {
            return new ErrorResponse('An error has occurred when updating the location category');
        }

        return LocationCategory::find($id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroyed = LocationCategory::destroy($id);

        if (! $destroyed) {
            return new ErrorResponse('Something went wrong deleting the location category');

        }

        return new DestroyResponse();
    }
}
