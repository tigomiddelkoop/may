<?php

namespace App\Http\Controllers;

use App\Classes\DestroyResponse;
use App\Classes\ErrorResponse;
use App\Classes\GetResponse;
use App\Classes\StoreResponse;
use App\Classes\UpdateResponse;
use App\Http\Requests\Location\StoreRequest;
use App\Http\Requests\Location\UpdateRequest;
use App\Models\Location;

class LocationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $locations = Location::orderBy('id')->get();

        return new GetResponse($locations);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $location = new Location();

        $location->name = $validated['name'];
        $location->address = $validated['address'];

        $location->locationCategory()->associate($validated['location_category_id']);

        $saved = $location->saveOrFail();

        if (! $saved) {
            return new ErrorResponse('An error has occurred when storing the location');
        }

        return new StoreResponse($location->refresh());

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $location = Location::with(['locationCategory'])->where('id', $id)->first();

        return new GetResponse($location);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $location = Location::find($id);

        if (isset($validated['name']) && $location->name != $validated['name']) {
            $location->name = $validated['name'];
        }

        if (isset($validated['address']) && $location->address != $validated['address']) {
            $location->address = $validated['address'];
        }

        if (isset($validated['location_category_id']) && $location->location_category_id != $validated['location_category_id']) {
            $location->locationCategory()->associate($validated['location_category_id']);
        }

        $updated = $location->update();
        if (! $updated) {
            return new ErrorResponse('An error has occurred when updating the location');
        }

        return new UpdateResponse(Location::find($id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroyed = Location::destroy($id);

        if (! $destroyed) {
            return new ErrorResponse('Something went wrong deleting the location');
        }

        return new DestroyResponse();
    }
}
