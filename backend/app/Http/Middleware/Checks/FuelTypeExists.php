<?php

namespace App\Http\Middleware\Checks;

use App\Models\FuelType;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class FuelTypeExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (! FuelType::where('id', $request->id)->exists()) {
            abort(404, 'Fuel Type does not exist');
        }

        return $next($request);
    }
}
