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

        $comments = $request->input('comments', []);
        $createdComments = [];

        foreach ($comments as $commentData) {

            $comment = $space->comments()->create([
                'comment' => $commentData['comment'],
                'score' => $commentData['score'],
                'status' => 'n',
                'user_id' => auth()->id(),
            ]);

            // Agregar imágenes asociadas a este comentario (si existen)
            $images = $commentData['images'] ?? [];
            foreach ($images as $url) {
                $comment->images()->create(['url' => $url]);
            }

            // Agregar el comentario y sus imágenes al array de response
            $createdComments[] = [
                'id' => auth()->id(),
                'comment' => $comment->comment,
                'score' => $comment->score,
                'user_id' => $comment->user_id,
                'images' => $comment->images->pluck('url')->toArray(),
            ];
        }

        return response()->json([
            'comments' => $createdComments,
            'message' => 'Comentarios creados correctamente',
        ], 201);
    }





}
