<?php

namespace App\Http\Middleware\Checks;

use App\Classes\NotFoundResponse;
use App\Models\LocationCategory;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LocationCategoryExists
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response|NotFoundResponse
    {
        if (! is_numeric($request->id)) {
            return new NotFoundResponse('Specified ID is not a number');
        }

        if (! LocationCategory::where('id', $request->id)->exists()) {
            return new NotFoundResponse();
        }

        return $next($request);
    }
}
