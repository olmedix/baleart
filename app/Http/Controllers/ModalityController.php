<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Modality;

class ModalityController extends Controller
{
    public function index() { 
        $modalities = Modality::all(); 
        return response()->json($modalities); 
    }
}
