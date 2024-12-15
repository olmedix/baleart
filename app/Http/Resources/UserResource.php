<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            "id" => $this->id,
            "nombre" => $this->name,
            "apellido" => $this->lastName,
            "email" => $this->email,
            "telefono" => $this->phone,
            "fecha_creacion" => $this->created_at->format('Y-m-d H:i:s'),
            "fecha_actualizacion" => $this->updated_at->format('Y-m-d H:i:s'),
            'spaces' => SpaceResource::collection($this->whenLoaded('spaces')),
            'comments' => CommentResource::collection($this->whenLoaded('comments')),
        ];
    }
}
