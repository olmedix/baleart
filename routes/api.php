<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\SpaceController;
use App\Http\Middleware\ApiKeyMiddleware;
use App\Http\Controllers\Api\AuthController;

//AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//SPACES
Route::post('/spaces/{regNumber}', [SpaceController::class, 'store']);
Route::apiresource('spaces', SpaceController::class);

Route::middleware('auth:sanctum')->group(function () {
    //Logout
    Route::post('/logout', [AuthController::class, 'logout']);

    //USERS
    Route::put('/user/{value}', [UserController::class, 'update']);
    Route::apiresource('user', UserController::class);



});

//protegidas por API Key Middleware
Route::middleware([ApiKeyMiddleware::class])->group(function () {
    Route::get('/protected-route', [AuthController::class, 'protectedRoute']);
});






