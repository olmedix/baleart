<?php

namespace App\Http\Controllers;

use App\Models\Space;
use Illuminate\Http\Request;
use App\Http\Resources\SpaceResource;
use App\Http\Requests\GuardarSpaceRequest;


class SpaceController extends Controller
{

    public function index(Request $request)
    {
        $query = Space::with([
            "address",
            "modalities",
            "services",
            "spaceType",
            "comments" => function ($query) {
                $query->where("status", "y");
            },
            "comments.images",
            "user"
        ]);

        // Aplicar filtro por isla si se pasa en la solicitud
        if ($request->has('island')) {
            $islandName = $request->get('island');
            $query->whereHas('address.municipality.island', function ($q) use ($islandName) {
                $q->where('name', $islandName);
            });
        }

        $spaces = $query->get();

        return SpaceResource::collection($spaces)->additional(['meta' => 'Espacio encontrado correctamente']);
    }



    public function show($value)
    {
        $query = Space::with([
            "address",
            "modalities",
            "services",
            "spaceType",
            "comments" => function ($query) {
                $query->where("status", "y");
            },
            "comments.images",
            "user"
        ])->get();

        $space = is_numeric($value)
            ? $query->findOrFail($value)  // Busca por 'id'
            : $query->where('regNumber', $value)->firstOrFail();

        return (new SpaceResource($space))->additional(['meta' => 'Espacio encontrado correctamente']);
    }


    public function store(GuardarSpaceRequest $request, $regNumber)
    {

        $space = Space::where('regNumber', $regNumber)->firstOrFail();

        // Crear el comentario asociado al space,no es necesario añadir el space_id ya que se hace automáticamente.
        $comment = $space->comments()->create([
            'comment' => $request->input('comment'),
            'score' => $request->input('score'),
            'status' => 'n',
            //'user_id' => auth()->id(), // Usar el ID del usuario autenticado
            'user_id' => 1
        ]);

        // Agregar imágenes asociadas al comentario (si existen)
        $images = $request->input('images', []); // Obtener las imágenes o un array vacío
        foreach ($images as $url) {
            $comment->images()->create(['url' => $url]);
        }

        return response()->json([
            'comentario' => $comment,
            'mensaje' => 'Comentario creado correctamente',
        ]);

    }




}
