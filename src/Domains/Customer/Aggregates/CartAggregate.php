<?php

namespace Domains\Customer\Aggregates;

use Domains\Customer\Events\CartItemQuantityDecreased;
use Domains\Customer\Events\CartItemQuantityIncreased;
use Domains\Customer\Events\CouponApplied;
use Domains\Customer\Events\CouponRemoved;
use Domains\Customer\Events\ProductAddedToCart;
use Domains\Customer\Events\ProductRemovedFromCart;
use Spatie\EventSourcing\AggregateRoots\AggregateRoot;

class CartAggregate extends AggregateRoot
{
    public function addProduct($cartID, $purchasableID, $purchasableType)
    {
        $this->recordThat(
            new ProductAddedToCart($cartID, $purchasableID, $purchasableType)
        );
        return $this;
    }

    public function removeProduct($cartID, $purchasableID, $purchasableType)
    {
        $this->recordThat(
            new ProductRemovedFromCart($cartID, $purchasableID, $purchasableType)
        );
        return $this;
    }

    public function increaseQuantity($cartID, $cartItemID, $quantity)
    {
        $this->recordThat(
            new CartItemQuantityIncreased($cartID, $cartItemID, $quantity)
        );
        return $this;
    }

    public function decreaseQuantity($cartID, $cartItemID, $quantity)
    {
        $this->recordThat(
            new CartItemQuantityDecreased($cartID, $cartItemID, $quantity)
        );
        return $this;
    }

    public function applyCoupon($cartID, $code)
    {
        $this->recordThat(
            new CouponApplied($cartID, $code)
        );
        return $this;
    }

    public function removeCoupon($cartID, $code)
    {
        $this->recordThat(
            new CouponRemoved($cartID, $code)
        );
        return $this;
    }
}