<?php

namespace App\Http\Resources\Api\V1;

use Illuminate\Http\Resources\Json\JsonResource;

class CartItemResource extends JsonResource
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
            'id' => $this->uuid,
            'type' => 'cart-item',
            'attributes' => [
                'id' => $this->uuid,
                'quantity' => $this->quantity,
                'item' => [
                    'id' => $this->purchasable_id,
                    'type' => $this->purchasable_type,
                ]
            ],
            'relationships' => [
                'cart' => new CartResource(
                    $this->whenLoaded(
                        'cart',
                    ),
                )
            ]
        ];
    }
}
