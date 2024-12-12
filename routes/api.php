<?php

use Illuminate\Http\Request;

use App\Http\Controllers\UserController;
use App\Http\Controllers\SpaceController;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//SPACES
Route::apiresource('users', UserController::class);
Route::post('/spaces/{regNumber}', [SpaceController::class, 'store']);

//USERS
Route::apiresource('spaces', SpaceController::class);

//AUTH
Route::post('/register', [AuthController::class, 'register']);



