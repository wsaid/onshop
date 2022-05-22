<?php 

namespace Tests\Feature;

use Domains\Catalog\Models\Product;
use Domains\Catalog\Models\Variant;
use Domains\Customer\Aggregates\CartAggregate;
use Domains\Customer\Events\ProductAddedToCart;
use Domains\Customer\Models\Cart;

it('Can store an event for adding a product', function() {

    $variant = Variant::factory()->create();
    $cart = Cart::factory()->create();

    $productAddedToCart = new ProductAddedToCart(
        $cart->id,
        $variant->id,
        Variant::class,
    );

    CartAggregate::fake()
        ->given([$productAddedToCart])
        ->when(function(CartAggregate $cartAggregate) use($variant, $cart) {
            $cartAggregate->addProduct($cart->id, $variant->id, Variant::class);
        })
        ->assertEventRecorded(new ProductAddedToCart(
            $cart->id,
            $variant->id,
            Variant::class
        ));
});