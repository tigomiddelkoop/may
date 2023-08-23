<?php

namespace App\Http\Middleware\Checks;

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
    public function handle(Request $request, Closure $next): Response
    {
        if (!Vehicle::where('id', $request->id)->exists()) {
            abort(404, 'Vehicle Not Found');
        }

        return $next($request);
    }
}
