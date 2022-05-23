<?php

namespace Domains\Customer\Actions;

use Domains\Customer\Aggregates\CartAggregate;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\CartItem;

class ChangeCartItemQuantity
{

    public static function handle(Cart $cart, CartItem $item, int $quantity = 0)
    {
        $aggregate = CartAggregate::retrieve(
            $item->cart->uuid
        );

        switch ($quantity) {
            case 0:
                RemoveProductFromCart::handle($cart, $item);
                break;
            case $quantity > $item->quantity:
                $aggregate->increaseQuantity(
                    $item->cart->id,
                    $item->id,
                    $quantity,
                )->persist();
                break;
            case $quantity < $item->quantity:
                $aggregate->decreaseQuantity(
                    $item->cart->id,
                    $item->id,
                    $quantity,
                )->persist();
                break;
        }
    }
}
