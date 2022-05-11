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
        $variant->id,
        Variant::class,
        $cart->id
    );

    CartAggregate::fake()
        ->given([$productAddedToCart])
        ->when(function(CartAggregate $cartAggregate) use($variant, $cart) {
            $cartAggregate->addProduct($variant->id, Variant::class, $cart->id);
        })
        ->assertEventRecorded(new ProductAddedToCart(
            $variant->id,
            Variant::class,
            $cart->id
        ));
});