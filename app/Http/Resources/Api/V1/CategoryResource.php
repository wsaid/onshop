<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoryResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'type' => $this->resourceType,
            'attributes' => [
                'key' => $this->key,
                'name' => $this->name,
                'description' => $this->description,
                'active' => $this->active,
            ],
            'relationships' => [
                'products' => ProductResource::collection(
                    $this->whenLoaded(
                        'products',
                    ),
                ),
            ]
        ];
    }
}
