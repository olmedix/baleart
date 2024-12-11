<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Http\Resources\AddressResource;
use App\Http\Resources\ServiceResource;
use App\Http\Resources\ModalityResource;
use App\Http\Resources\SpaceTypeResource;
use Illuminate\Http\Resources\Json\JsonResource;
use App\Http\Resources\CommentResource;

class SpaceResource extends JsonResource
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
            'nombre' => $this->name,
            'numero_registro' => $this->regNumber,
            'observacion_ca' => $this->observation_CA,
            'observacion_es' => $this->observation_ES,
            'observacion_en' => $this->observation_EN,
            'email' => $this->email,
            'telefono' => $this->phone,
            'web' => $this->website,
            'tipo_acceso' => $this->access_types,
            'puntuacion_total' => $this->totalScore,
            'puntuacion_contador' => $this->countScore,
            'fecha_creacion' => $this->created_at->format('Y-m-d H:i:s'),
            'fecha_actualizacion' => $this->updated_at->format('Y-m-d H:i:s'),
            'direccion' => new AddressResource($this->whenLoaded('address')),
            'modalidades' => ModalityResource::collection($this->whenLoaded('modalities')),
            'servicios' => ServiceResource::collection($this->whenLoaded('services')),
            'tipo_espacio' => new SpaceTypeResource($this->whenLoaded('spaceType')),
            'comentarios' => CommentResource::collection($this->whenLoaded('comments')),
            'usuario' => new UserResource($this->whenLoaded('user')),
        ];
    }

}
