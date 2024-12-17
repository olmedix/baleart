<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Support\Facades\Auth;

class ApiKeyMiddleware
{

    public function handle(Request $request, Closure $next): Response
    {
        // Verificar si el usuario está autenticado con Sanctum
        if (Auth::guard('sanctum')->check()) {
            // Si está autenticado con Sanctum, pasa directamente al siguiente middleware
            return $next($request);
        }

        $apiKey = $request->header('x-api-key');

        if ($apiKey !== env('API_KEY')) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        return $next($request);
    }
}
