<?php

namespace App\Http\Middleware\Checks;

use App\Classes\ClientErrorResponse;
use App\Classes\NotFoundResponse;
use App\Models\LocationCategory;
use Closure;
use Illuminate\Http\Request;
use Ramsey\Uuid\Uuid;
use Symfony\Component\HttpFoundation\Response;

class LocationCategoryExists
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

        if (! LocationCategory::where('id', $request->id)->exists()) {
            return new NotFoundResponse();
        }

        return $next($request);
    }
}
