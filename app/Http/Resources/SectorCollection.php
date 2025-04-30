<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class SectorCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->transform(function($sector){
                return [
                    'id' => $sector->id,
                    'crop_name' => $sector->crop_name,
                    'soil_type' => $sector->soil_type,
                    'season' => $sector->season,
                    'area' => $sector->area,
                    'irrigation_type' => $sector->irrigation_type,
                    'ph' => $sector->ph,
                    'area_name' => $sector->Area->name,
                ];

            })
        ];
        return parent::toArray($request);
    }
}
