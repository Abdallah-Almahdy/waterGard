<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class AreaCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'data' => $this->collection->transform(function($area){

                return [
                    'id' => $area->id,
                    'name' => $area->name,
                    'region' => $area->region->name
                ];
            })
        ];
        return parent::toArray($request);
    }
}
