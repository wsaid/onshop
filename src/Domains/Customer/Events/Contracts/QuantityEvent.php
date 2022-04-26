<?php

namespace Domains\Customer\Events\Contracts;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

abstract class CartItemQuantityEvent extends ShouldBeStored
{
    public function __construct($cartID, $cartItemID, $quantity)
    {
        
    }
}