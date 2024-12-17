<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\ApiKeyMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            Route::middleware('api')
                ->prefix('api')
                ->group(base_path('routes/api.php'));
            Route::middleware('web')
                ->group(base_path('routes/web.php'));
        },

    )
    ->withMiddleware(function (Middleware $middleware) {
        // Registrar middleware personalitzat
        $middleware->alias([
            'ApiKeyMiddleware' => ApiKeyMiddleware::class,
        ]);

        $middleware->api("throttle:api");
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (NotFoundHttpException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Element not found',
                ], 404);
            }
        });

        // Manejar errores relacionados con Sanctum
        $exceptions->render(function (\Illuminate\Auth\AuthenticationException $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Unauthenticated, please login',
                ], 401);
            }
        });

        // Manejo genérico de cualquier otra excepción en rutas de API
        $exceptions->render(function (\Exception $e, $request) {
            if ($request->is('api/*')) {
                return response()->json([
                    'message' => 'Server error',
                    'error' => $e->getMessage(),
                ], 500);
            }
        });


    })->create();
