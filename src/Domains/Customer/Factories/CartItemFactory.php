<?php

namespace Domains\Customer\Factories;

use Domains\Customer\ValueObjects\CartItemValueObject;

class CartItemFactory {

    public static function make(array $attribute)
    {
        return new CartItemValueObject(
            $attribute['quantity'],
            $attribute['purchasable_id'],
            $attribute['purchasable_type']
        );
    }
}