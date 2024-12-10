<?php

namespace App\Http\Controllers;

use App\Models\Space;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Space::with(["address", "modalities", "services", "spaceType", "comments", "comments.images", "user"]);

        // Filtra por isla si el parámetro existe
        // Ejemplo: http://baleart.test/api/spaces?island=Mallorca
        if ($request->has('island')) {
            $islandName = $request->get('island');
            $query->whereHas('address.municipality.island', function ($q) use ($islandName) {
                $q->where('name', $islandName);
        });
        }
        $spaces = $query->get();

        return response()->json($spaces);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function search($value)
    {
        if (empty($value)) {
            return response()->json(['error' => 'El valor de búsqueda no puede estar vacío.'], 400);
        }
        
        $space = is_numeric($value)
            ? Space::findOrFail($value)  // Busca por 'id'
            : Space::where('regNumber', $value)->firstOrFail(); // Busca por 'regNumber'

        return (new SpaceResource($space))->additional(['meta' => 'Espacio encontrado correctamente']);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
