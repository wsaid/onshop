<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
                'price' => [
                    'cost' => $this->cost,
                    'retail' => $this->retail, // product.attributes.price.retail
                ],
                'active' => $this->active,
                'vat' => $this->vat,
            ],
            'relationships' => [
                'category' => new CategoryResource(
                    $this->whenLoaded(
                        'category',
                    ),
                ),
                'range' => new RangeResource(
                    $this->whenLoaded(
                        'range',
                    ),
                ),
                'variants' => VariantResource::collection(
                    $this->whenLoaded(
                        'variants',
                    ),
                ),
            ],
            'links' => [
                '_self' => route('api:v1:products:show', $this->key),
                '_parent' => route('api:v1:products:index'),
            ]
        ];
    }
}
