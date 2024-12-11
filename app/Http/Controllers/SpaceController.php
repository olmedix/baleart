<?php

namespace App\Http\Controllers;

use App\Models\Space;
use App\Models\SpaceType;
use Illuminate\Http\Request;
use App\Http\Resources\SpaceResource;

class SpaceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Space::with(["address", "modalities", "services", "spaceType", "comments", "comments.images", "user"]);

        // Aplicar filtro por isla si se pasa en la solicitud
        if ($request->has('island')) {
            $islandName = $request->get('island');
            $query->whereHas('address.municipality.island', function ($q) use ($islandName) {
                $q->where('name', $islandName);
            });
        }

        // Recuperar espacios con paginación para evitar grandes volúmenes de datos
        $spaces = $query->paginate(15);

        // Devolver respuesta formateada con metadatos
        //return response()->json($spaces);
        return SpaceResource::collection($spaces)->additional(['meta' => 'Espacio encontrado correctamente']);
    }



    public function show($value)
    {

        $query = Space::with([
            "address",
            "modalities",
            "services",
            "spaceType",
            "comments",
            "comments.images",
            "user"
        ])->get();

        $space = is_numeric($value)
            ? $query->findOrFail($value)  // Busca por 'id'
            : $query->where('regNumber', $value)->firstOrFail(); // Busca por 'regNumber'

        return (new SpaceResource($space))->additional(['meta' => 'Espacio encontrado correctamente']);
        //return response()->json($space);
    }

    public function store(Request $request)
    {

    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

}
