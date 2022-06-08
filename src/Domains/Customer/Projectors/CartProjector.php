<?php

namespace Domains\Customer\Projectors;

use Domains\Customer\Aggregates\CartAggregate;
use Domains\Customer\Events\CartItemQuantityDecreased;
use Domains\Customer\Events\CartItemQuantityIncreased;
use Domains\Customer\Events\CouponApplied;
use Domains\Customer\Events\CouponRemoved;
use Domains\Customer\Events\ProductAddedToCart;
use Domains\Customer\Events\ProductRemovedFromCart;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\CartItem;
use Domains\Customer\Models\Coupon;
use Spatie\EventSourcing\EventHandlers\Projectors\Projector;
use Illuminate\Support\Str;

class CartProjector extends Projector
{
    public function onProductAddedToCart(ProductAddedToCart $event)
    {
        $cart = Cart::query()->find($event->cartID);

        $cart->items()->create([
            'purchasable_id' => $event->purchasableID,
            'purchasable_type' => $event->purchasableType,
            'quantity' => 1
        ]);
    }

    public function onProductRemovedFromCart(ProductRemovedFromCart $event)
    {
        $cart = Cart::query()->find($event->cartID);

        $cart->items()->where([
            'purchasable_id' => $event->purchasableID,
            'purchasable_type' => $event->purchasableType
        ])->delete();
    }

    public function onCartItemQuantityIncreased(CartItemQuantityIncreased $event)
    {
        $cartItem = CartItem::query()->find($event->cartItemID);
        $cartItem->increment('quantity', $event->quantity);
    }

    public function onCartItemQuantityDecreased(CartItemQuantityDecreased $event)
    {
        $cartItem = CartItem::query()->find($event->cartItemID);
        if ($event->quantity >= $cartItem->quantity) {
            CartAggregate::retrieve(Str::uuid()->toString())
                ->removeProduct($cartItem->purchasable_id, $cartItem->purchasable_type, $cartItem->cart_id);
        }
        $cartItem->decrement('quantity', $event->quantity);
    }

    public function onCouponApplied(CouponApplied $event)
    {
        $coupon = Coupon::query()->where(
            'code', 
            $event->code
        )->first();
        
        Cart::query()->where(
            'id',
            $event->cartID
        )->update([
            'coupon' => $coupon->code,
            'reduction' => $coupon->reduction
        ]);
    }

    public function onCouponRemoved(CouponRemoved $event)
    {
        Cart::query()->where(
            'id',
            $event->cartID
        )->update([
            'coupon' => null,
            'reduction' => 0
        ]);
    }
}