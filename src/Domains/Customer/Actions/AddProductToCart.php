<?php

namespace Domains\Customer\Actions;

use Domains\Customer\Models\Cart;
use Domains\Customer\ValueObjects\CartItemValueObject;

class AddProductToCart {

    public static function handle(CartItemValueObject $cartItem, Cart $cart)
    {
        return $cart->items()->create($cartItem->toArray());
    }
}