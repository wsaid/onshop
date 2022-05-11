<?php

namespace Domains\Customer\Actions;

use Domains\Customer\Models\Cart;
use Domains\Customer\ValueObjects\CartValueObject;

class CreateCart {

    public static function handle(CartValueObject $cart)
    {
        return Cart::query()->create($cart->toArray());
    }
}