<?php

namespace App\Http\Middleware\Checks;

use App\Classes\NotFoundResponse;
use App\Models\Vehicle;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehicleExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response|NotFoundResponse
    {
        //        if (! is_numeric($request->id)) {
        //            return new NotFoundResponse('Specified ID is not a number');
        //        }

        if (! Vehicle::where('license_plate', $request->license_plate)->exists()) {
            return new NotFoundResponse([], 'The vehicle does not exist');
        }

        return $next($request);
    }
}
