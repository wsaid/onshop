<?php

namespace Tests\Feature;

use Domains\Catalog\Models\Variant;
use Domains\Customer\Enums\CartStatus;
use Domains\Customer\Events\ProductAddedToCart;
use Domains\Customer\Models\Cart;
use Illuminate\Testing\Fluent\AssertableJson;
use Spatie\EventSourcing\StoredEvents\Models\EloquentStoredEvent;
use Symfony\Component\HttpFoundation\Response;

use function Pest\Laravel\post;
use function Pest\Laravel\get;


it('Can create cart for unauthenticated user', function () {

    post(route('api:v1:carts:store'))
        ->assertStatus(Response::HTTP_CREATED)
        ->assertJson(
            fn (AssertableJson $json)  =>
            $json->where('type', 'cart')
                ->where('attributes.status', CartStatus::PENDING()->label)
                ->etc()
        );
});

it('Can create cart for authenticated user', function () {
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

it('Return no content when guest tries to retrieve a cart', function () {
    get(route('api:v1:carts:index'))
        ->assertStatus(Response::HTTP_NO_CONTENT);
});


it('Can add a product to a cart', function () {
    // expect(EloquentStoredEvent::query()->get())->toHaveCount(0);

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

    // expect(EloquentStoredEvent::query()->get())->toHaveCount(1);
    // expect(EloquentStoredEvent::query()->first()->event_class)->toEqual(ProductAddedToCart::class);
});
