<?php

namespace Domains\Customer\ValueObjects;

class CartItemValueObject {

    public function __construct($quantity, $purchasableID, $purchasableType) {
        $this->quantity = $quantity;
        $this->purchasableID = $purchasableID;
        $this->purchasableType = $purchasableType;
    }

    /**
     * @return array
     */
    public function toArray()
    {
        return [
            'quantity' => $this->quantity,
            'purchasable_id' => $this->purchasableID,
            'purchasable_type' => $this->purchasableType
        ];
    }
}