<?php

namespace App\Http\Controllers;

use App\Http\Requests\GuardarSpaceRequest;
use App\Models\Space;
use App\Models\SpaceType;
use Illuminate\Http\Request;
use App\Http\Resources\SpaceResource;

class SpaceController extends Controller
{

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


    /*EJEMPLO DE PETICIÓN STORE
    {
        "comment": "This is a test comment.",
        "score": 4.5,
        "images": ["image1.jpg", "image2.png"]
    }
    */
    public function store(GuardarSpaceRequest $request, $regNumber)
    {
        // Buscar el espacio por regNumber
        $space = Space::where('regNumber', $regNumber)->firstOrFail();

        // Crear el comentario asociado al space
        $comment = $space->comments()->create([
            'comment' => $request->input('comment'),
            'score' => $request->input('score'),
            'user_id' => auth()->id(), // Usar el ID del usuario autenticado
            'status' => 'n' // Por defecto
        ]);

        // Agregar imágenes asociadas al comentario (si existen)
        $images = $request->input('images', []); // Obtener las imágenes o un array vacío
        foreach ($images as $url) {
            $comment->images()->create(['url' => $url]);
        }

        return response()->json([
            $comment,
            'message' => 'Comentario creado correctamente',
        ]);
    }

    public function update(Request $request, $id)
    {

    }

    public function destroy($id)
    {

    }

}
