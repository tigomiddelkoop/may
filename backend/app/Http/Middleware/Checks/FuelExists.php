<?php

namespace App\Http\Middleware\Checks;

use App\Models\Fuel;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FuelExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! Fuel::where('id', $request->id)->exists()) {
            abort(404, 'Fuel does not exist');
        }

        return $next($request);
    }
}
