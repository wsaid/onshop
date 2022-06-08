<?php

namespace Tests\Feature;

use Domains\Catalog\Models\Variant;
use Domains\Customer\Enums\CartStatus;
use Domains\Customer\Events\CouponApplied;
use Domains\Customer\Events\CouponRemoved;
use Domains\Customer\Events\ProductAddedToCart;
use Domains\Customer\Events\ProductRemovedFromCart;
use Domains\Customer\Models\Cart;
use Domains\Customer\Models\CartItem;
use Domains\Customer\Models\Coupon;
use Illuminate\Testing\Fluent\AssertableJson;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\post;
use function Pest\Laravel\get;
use function Pest\Laravel\patch;
use function Pest\Laravel\delete;

it('can create cart for unauthenticated user', function () {

    post(route('api:v1:carts:store'))
        ->assertStatus(Response::HTTP_CREATED)
        ->assertJson(
            fn (AssertableJson $json)  =>
            $json->where('type', 'cart')
                ->where('attributes.status', CartStatus::PENDING()->label)
                ->etc()
        );
});

it('can create cart for authenticated user', function () {
    $cart = Cart::factory()->create();
    auth()->loginUsingId($cart->user->id);

    get(route('api:v1:carts:index'))
        ->assertStatus(Response::HTTP_OK)
        ->assertJson(
            fn (AssertableJson $json)  =>
            $json->where('type', 'cart')
                ->where('attributes.status', function($status) {
                    return in_array($status, CartStatus::toLabels());
                })
                ->etc()
        );
});

it('return no content when guest tries to retrieve a cart', function () {
    get(route('api:v1:carts:index'))
        ->assertStatus(Response::HTTP_NO_CONTENT);
});


it('can add a product to a cart', function () {
    expect(EloquentStoredEvent::query()->get())->toHaveCount(0);

    $cart = Cart::factory()->create();
    $variant = Variant::factory()->create();

    post(
        route('api:v1:carts:products:store', $cart->uuid),
        [
            'quantity' => 1,
            'purchasable_id' => $variant->id,
            'purchasable_type' => 'variant'
        ]
    )->assertStatus(Response::HTTP_CREATED);

    expect(EloquentStoredEvent::query()->get())->toHaveCount(1);
    expect(EloquentStoredEvent::query()->first()->event_class)->toEqual(ProductAddedToCart::class);
});

it('can increase the quantity of an item in the cart', function() {
    $cartItem = CartItem::factory()->create(['quantity' => 1]);
    expect($cartItem->quantity)->toEqual(1);

    patch(
        route('api:v1:carts:products:update', [
            'cart' => $cartItem->cart->uuid,
            'item' => $cartItem->uuid
        ]),
        [
            'quantity' => 5
        ]
    )->assertStatus(Response::HTTP_ACCEPTED);

    expect(CartItem::query()->find($cartItem->id)->quantity)->toEqual(6);
});

it('can decrease the quantity of an item in the cart', function() {
    $cartItem = CartItem::factory()->create(['quantity' => 5]);
    expect($cartItem->quantity)->toEqual(5);

    patch(
        route('api:v1:carts:products:update', [
            'cart' => $cartItem->cart->uuid,
            'item' => $cartItem->uuid
        ]),
        [
            'quantity' => 2
        ]
    )->assertStatus(Response::HTTP_ACCEPTED);

    expect(CartItem::query()->find($cartItem->id)->quantity)->toEqual(3);
});

it('remove an item from the cart when quantity is zero', function() {
    $cartItem = CartItem::factory()->create(['quantity' => 1]);
    expect($cartItem->quantity)->toEqual(1);
    expect(CartItem::all())->toHaveCount(1);

    patch(
        route('api:v1:carts:products:update', [
            'cart' => $cartItem->cart->uuid,
            'item' => $cartItem->uuid
        ]),
        [
            'quantity' => 0
        ]
    )->assertStatus(Response::HTTP_ACCEPTED);

    expect(EloquentStoredEvent::query()->get())->toHaveCount(1);
    expect(EloquentStoredEvent::query()->first()->event_class)->toEqual(ProductRemovedFromCart::class);
    expect(CartItem::all())->toHaveCount(0);
});

it('can remove an item from the cart', function() {
    $cartItem = CartItem::factory()->create(['quantity' => 1]);
    expect($cartItem->quantity)->toEqual(1);
    
    delete(
        route('api:v1:carts:products:delete', [
            'cart' => $cartItem->cart->uuid,
            'item' => $cartItem->uuid
        ])
    )->assertStatus(Response::HTTP_ACCEPTED);

    expect(CartItem::all())->toHaveCount(0);
});