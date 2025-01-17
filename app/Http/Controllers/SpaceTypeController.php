<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpaceType;

class SpaceTypeController extends Controller
{
    public function index() { 
        $typeSpace = SpaceType::all(); 
        return response()->json($typeSpace); 
    }
}
