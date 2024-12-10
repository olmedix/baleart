<?php

use Illuminate\Http\Request;

use App\Http\Controllers\UserController;
use App\Http\Controllers\SpaceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::apiresource('users', UserController::class);
Route::apiresource('spaces', SpaceController::class);

//PARA SHOW
Route::get('spaces/search/{value}', [SpaceController::class, 'search']);
