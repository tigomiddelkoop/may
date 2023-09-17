<?php

namespace App\Http\Middleware\Checks;

use App\Classes\ClientErrorResponse;
use App\Classes\ErrorResponse;
use App\Classes\NotFoundResponse;
use App\Models\ActivityCategory;
use App\Models\ActivityExpense;
use App\Models\EngineType;
use App\Models\Fuel;
use App\Models\FuelExpense;
use App\Models\FuelType;
use App\Models\Location;
use App\Models\LocationCategory;
use App\Models\Vehicle;
use App\Models\VehicleType;
use Closure;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class RecordExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, string $type): Response|ErrorResponse|NotFoundResponse|ClientErrorResponse
    {
        $model = null;
        $checkType = 'uuid';
        $idColumn = 'id';
        switch ($type) {
            case 'fuel':
                $model = Fuel::class;
                break;
            case 'fuel.type':
                $model = FuelType::class;
                break;
            case 'fuel.expense':
                $model = FuelExpense::class;
                break;

            case 'activity.category':
                $model = ActivityCategory::class;
                break;
            case 'activity.expense':
                $model = ActivityExpense::class;
                break;

            case 'engine.type':
                $model = EngineType::class;
                break;

            case 'location':
                $model = Location::class;
                break;
            case 'location.category':
                $model = LocationCategory::class;
                break;

            case 'vehicle':
                $model = Vehicle::class;
                $checkType = 'string';
                $idColumn = 'license_plate';
                break;
            case 'vehicle.type':
                $model = VehicleType::class;
                break;
        }

        // If model throw error as we are using the middleware somewhere we should not be using it
        if ($model == null) {
            return new ErrorResponse();
        }

        // Check for specific check
        if ($checkType == 'uuid' && ! Uuid::isValid($request->{$idColumn})) {
            return new ClientErrorResponse(message: 'Specified id is not valid a valid uuid');
        }
        if ($checkType == 'string' && ! is_string($request->{$idColumn})) {
            return new ClientErrorResponse(message: 'Specified id is not valid a valid string');
        }

        if (! $model::where($idColumn, $request->{$idColumn})->exists()) {
            return new NotFoundResponse([], 'The record does not exist');
        }

        return $next($request);
    }
}
