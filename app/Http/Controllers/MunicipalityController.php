<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Municipality;

class MunicipalityController extends Controller
{
    public function index() { 
        $municipalities = Municipality::all(); 
        return response()->json($municipalities); 
    }
}

