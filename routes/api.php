<?php

use Illuminate\Http\Request;

use App\Http\Controllers\UserController;
use App\Http\Controllers\SpaceController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::bind('space', function ($value) { 
    return is_numeric($value) 
    ?   Space::findOrFail($value)
    :   Space::whereHas('address.municipality.island', 
                    function ($query) use ($value) { 
                        $query->where('name', $value); 
                    })->firstOrFail();
        }
    );


Route::apiresource('users', UserController::class);
Route::apiresource('spaces', SpaceController::class);
