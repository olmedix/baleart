<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ModalityResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nombre' => $this->name,
            'descripcion_ca' => $this->description_CA,
            'descripcion_es' => $this->description_ES,
            'descripcion_en' => $this->description_EN,
            'fecha_creacion' => $this->created_at->format('Y-m-d H:i:s'),
            'fecha_actualizacion' => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
