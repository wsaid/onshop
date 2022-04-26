<?php

namespace Domains\Customer\Aggregates;

use Domains\Customer\Events\CartItemQuantityDecreased;
use Domains\Customer\Events\CartItemQuantityIncreased;
use Domains\Customer\Events\ProductAddedToCart;
use Domains\Customer\Events\ProductRemovedFromCart;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class CartAggregate extends AggregateRoot
{
    public function addProduct($purchasableID, $purchasableType, $cartID)
    {
        return $this->recordThat(
            new ProductAddedToCart($purchasableID, $purchasableType, $cartID)
        );
        return $this;
    }

    public function removeProduct($purchasableID, $purchasableType, $cartID)
    {
        return $this->recordThat(
            new ProductRemovedFromCart($purchasableID, $purchasableType, $cartID)
        );
        return $this;
    }

    public function increaseQuantity($cartID, $cartItemID, $quantity)
    {
        return $this->recordThat(
            new CartItemQuantityIncreased($cartID, $cartItemID, $quantity)
        );
        return $this;
    }

    public function decreaseQuantity($cartID, $cartItemID, $quantity)
    {
        return $this->recordThat(
            new CartItemQuantityDecreased($cartID, $cartItemID, $quantity)
        );
        return $this;
    }
}