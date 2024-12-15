<?php

use Illuminate\Http\Request;

use App\Http\Controllers\UserController;
use App\Http\Controllers\SpaceController;
use App\Http\Middleware\ApiKeyMiddleware;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


//USERS
Route::apiresource('users', UserController::class);

//SPACES
Route::post('/spaces/{regNumber}', [SpaceController::class, 'store']);
Route::apiresource('spaces', SpaceController::class);

//AUTH
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

//LOGIN
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//LOGOUT
Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
});

//API KEY
Route::middleware([ApiKeyMiddleware::class])->group(function () {
    Route::get('/protected-route', [AuthController::class, 'protectedRoute']);
});






