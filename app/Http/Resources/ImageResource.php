<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ImageResource extends JsonResource
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
            "id" => $this->id,
            "url_imagen" => $this->url,
            "fecha_creacion" => $this->created_at->format('Y-m-d H:i:s'),
            "fecha_actualizacion" => $this->updated_at->format('Y-m-d H:i:s'),
        ];
    }
}
