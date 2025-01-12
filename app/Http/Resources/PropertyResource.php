<?php

namespace App\Http\Resources;

use App\Http\Resources\OptionResource;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PropertyResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->resource->id,
            'title' => $this->resource->title,
            $this->mergeWhen(true, [
                'price' => $this->resource->price,
                'surface' => $this->resource->surface,
            ]),
            'options' => OptionResource::collection($this->whenLoaded('options')),
        ];
    }
}