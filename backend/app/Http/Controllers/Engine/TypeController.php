<?php

namespace App\Http\Controllers\Engine;

use App\Classes\DestroyResponse;
use App\Classes\ErrorResponse;
use App\Classes\GetResponse;
use App\Classes\StoreResponse;
use App\Classes\UpdateResponse;
use App\Http\Controllers\Controller;
use App\Http\Requests\Categories\StoreRequest;
use App\Http\Requests\Categories\UpdateRequest;
use App\Models\EngineType;

class TypeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $engineTypes = EngineType::orderBy('id')->get();

        return new GetResponse($engineTypes);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request)
    {
        $validated = $request->validated();
        $engineType = new EngineType();

        $engineType->name = $validated['name'];

        $saved = $engineType->saveOrFail();

        if (! $saved) {
            return new ErrorResponse('An error has occurred when storing the engine type');
        }

        return new StoreResponse($engineType->refresh());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $engineType = EngineType::with(['vehicles'])->find($id);

        return new GetResponse($engineType);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id)
    {
        $validated = $request->validated();
        $engineType = EngineType::find($id);

        // name
        if (isset($validated['name']) && $engineType->name != $validated['name']) {
            $engineType->name = $validated['name'];
        }

        $updated = $engineType->update();
        if (! $updated) {
            return new ErrorResponse('An error has occurred when updating the engine type');
        }

        return new UpdateResponse(EngineType::find($id));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $destroyed = EngineType::destroy($id);

        if (! $destroyed) {
            return new ErrorResponse('Something went wrong deleting the engine type');
        }

        return new DestroyResponse();
    }
}
