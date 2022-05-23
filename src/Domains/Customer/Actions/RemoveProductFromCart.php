<?php

namespace Domains\Customer\Actions;

use Domains\Customer\Aggregates\CartAggregate;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\CartItem;

class RemoveProductFromCart {

    public static function handle(Cart $cart, CartItem $item)
    {
        $aggregate = CartAggregate::retrieve(
            $item->cart->uuid
        );

        $aggregate->removeProduct(
            $item->cart->id,
            $item->id,
            get_class($item->purchasable)
        )->persist();
    }
}