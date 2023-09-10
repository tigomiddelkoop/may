<?php

namespace App\Http\Middleware\Checks;

use App\Classes\ClientErrorResponse;
use App\Classes\NotFoundResponse;
use App\Models\Vehicle;
use Closure;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class VehicleExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response|NotFoundResponse|ClientErrorResponse
    {
        if (! Uuid::isValid($request->id)) {
            return new ClientErrorResponse(message: 'Specified id is not valid a valid uuid');
        }

        if (! Vehicle::where('license_plate', $request->license_plate)->exists()) {
            return new NotFoundResponse([], 'The vehicle does not exist');
        }

        return $next($request);
    }
}
