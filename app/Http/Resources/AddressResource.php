<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class AddressResource extends JsonResource
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
            "zona" => $this->zone->name,
            "municipio" => $this->municipality->name,
            "fecha_creacion" => $this->created_at->format('Y-m-d H:i:s'),
            "fecha_actualizacion" => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
