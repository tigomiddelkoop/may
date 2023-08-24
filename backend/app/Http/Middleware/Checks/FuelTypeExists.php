<?php

namespace App\Http\Middleware\Checks;

use App\Models\FuelType;
use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class FuelTypeExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): JsonResponse
    {
        if (! is_numeric($request->id)) {
            return new JsonResponse([
                'code' => 'MAY-4000',
                'message' => 'Specified ID is not a number',
                'data' => [],
            ], 404);
        }

        if (! FuelType::where('id', $request->id)->exists()) {
            return new JsonResponse([
                'code' => 'MAY-4004',
                'message' => 'Fuel type not found',
                'data' => [],
            ], 404);
        }

        return $next($request);
    }
}
