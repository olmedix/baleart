<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\MunicipalityController;
use App\Http\Controllers\CommentController;
use App\Http\Middleware\ApiKeyMiddleware;
use App\Http\Controllers\Api\AuthController;

//AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
//CAMBIO PARA PERDIDA DE CONTRASEÑA
Route::get('/user/resetPassword/{email}', [UserController::class, 'getUserForPasswordReset']);
Route::put('/user/{value}', [UserController::class, 'update']);


Route::middleware([ApiKeyMiddleware::class])->group(function () {

    // Si el usuario está autenticado con Sanctum, pasa por el siguiente middleware
    Route::middleware('auth:sanctum')->group(function () {
        // Logout
        Route::post('/logout', [AuthController::class, 'logout']);
        // No se puede agregar un comentario si no estas logueado, no hay id del usuario.
        Route::post('/spaces/{regNumber}', [SpaceController::class, 'store']);
    });

    // Rutas protegidas por API Key Middleware
    
    Route::apiresource('user', UserController::class);
    Route::apiresource('spaces', SpaceController::class);
    Route::get('/municipalities', [MunicipalityController::class, 'index']);
    Route::get('/comments/{userId}',[CommentController::class, 'index']);
});

