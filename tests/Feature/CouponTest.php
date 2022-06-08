<?php

namespace Tests\Feature;

use Domains\Customer\Events\CouponApplied;
use Domains\Customer\Events\CouponRemoved;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\Coupon;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\post;
use function Pest\Laravel\delete;

it('can apply a coupon on the cart', function() {
    $coupon = Coupon::factory()->create();
    $cart = Cart::factory()->create(['coupon' => null, 'reduction' => 0]);

    expect($cart->reduction)->toEqual(0);
    expect(EloquentStoredEvent::query()->get())->toHaveCount(0);

    post(
        route('api:v1:carts:coupons:store', $cart->uuid), [
            'code' => $coupon->code

        ]
    )->assertStatus(Response::HTTP_ACCEPTED);

    $cart->refresh();
    expect($cart->reduction)->toEqual($coupon->reduction);
    expect($cart->coupon)->toEqual($coupon->code);

    expect(EloquentStoredEvent::query()->get())->toHaveCount(1);
    expect(EloquentStoredEvent::query()->first()->event_class)->toEqual(CouponApplied::class);
});

it('can delete a coupon from the cart', function() {
    $coupon = Coupon::factory()->create();
    
    $cart = Cart::factory()->create(['coupon' => null, 'reduction' => 0]);

    $cart->update([
        'coupon' => $coupon->code,
        'reduction' => $coupon->reduction
    ]);

    expect($cart->refresh()->reduction)->toEqual($coupon->reduction);

    delete(
        route('api:v1:carts:coupons:delete', [
            'cart' => $cart->uuid,
            'uuid' => $coupon->uuid
        ])
    )->assertStatus(Response::HTTP_ACCEPTED);

    expect($cart->refresh()->reduction)->toEqual(0);
    expect($cart->refresh()->coupon)->toBeNull();

    expect(EloquentStoredEvent::query()->get())->toHaveCount(1);
    expect(EloquentStoredEvent::query()->first()->event_class)->toEqual(CouponRemoved::class);
});