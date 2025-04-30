<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class SectorResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return[
            'id' => $this->id,
            'crop_name' => $this->crop_name,
            'soil_type' => $this->soil_type,
            'season' => $this->season,
            'area' => $this->area,
            'irrigation_type' => $this->irrigation_type,
            'ph' => $this->ph,
            'area_name' => $this->areas->name,
        ];
        return parent::toArray($request);
    }
}
