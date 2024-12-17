<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\SpaceController;
use App\Http\Middleware\ApiKeyMiddleware;
use App\Http\Controllers\Api\AuthController;

//AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);


Route::middleware([ApiKeyMiddleware::class])->group(function () {

    // Si el usuario está autenticado con Sanctum, pasa por el siguiente middleware
    Route::middleware('auth:sanctum')->group(function () {
        // Logout
        Route::post('/logout', [AuthController::class, 'logout']);
    });

    // Rutas protegidas por API Key Middleware
    Route::put('/user/{value}', [UserController::class, 'update']);
    Route::apiresource('user', UserController::class);
    Route::post('/spaces/{regNumber}', [SpaceController::class, 'store']);
    Route::apiresource('spaces', SpaceController::class);
});

