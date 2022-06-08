<?php

namespace Domains\Customer\Actions;

use Domains\Customer\Aggregates\CartAggregate;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\Coupon;
use Symfony\Component\HttpFoundation\Response;

class RemoveCouponFromCart {

    public static function handle(Cart $cart, string $uuid)
    {
        $coupon = Coupon::query()->where('uuid', $uuid)->firstOrFail();
        
        if ($cart->coupon != $coupon->code) {
            abort(Response::HTTP_NOT_FOUND);
        }

        $aggregate = CartAggregate::retrieve(
            $cart->uuid
        );

        $aggregate->removeCoupon(
            $cart->id,
            $coupon
        )->persist();
    }
}