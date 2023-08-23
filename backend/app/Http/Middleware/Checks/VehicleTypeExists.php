<?php

namespace App\Http\Middleware\Checks;

use App\Models\VehicleType;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class VehicleTypeExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! VehicleType::where('id', $request->id)->exists()) {
            abort(404, 'Vehicle Type Not Found');
        }

        return $next($request);
    }
}
