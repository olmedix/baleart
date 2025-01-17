<?php

namespace App\Http\Controllers;

use App\Models\Modality;
use App\Models\Service;
use App\Models\SpaceType;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public function index()
    {
        $services = Service::all();
        $modalities = Modality::all();
        $spaceTypes = SpaceType::all();

        $data = [
            'services' => $services,
            'modalities' => $modalities,
            'spaceTypes' => $spaceTypes
        ];
        return response()->json($data);
    }
}
