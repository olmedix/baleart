<?php

namespace App\Http\Resources;


use Illuminate\Http\Request;
use App\Http\Resources\ImageResource;
use Illuminate\Http\Resources\Json\JsonResource;

class CommentResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        //return parent::toArray($request);
        return [
            'id' => $this->id,
            'comentario' => $this->comment,
            'puntuacion' => $this->score,
            'estado' => $this->status,
            'usuario' => $this->user->name,
            'fecha_creacion' => $this->created_at->format('Y-m-d H:i:s'),
            'fecha_actualizacion' => $this->updated_at->format('Y-m-d H:i:s'),
            'imagenes' => ImageResource::collection($this->whenLoaded('images')),
        ];
    }
}
