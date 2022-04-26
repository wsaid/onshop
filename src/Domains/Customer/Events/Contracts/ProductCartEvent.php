<?php

namespace Domains\Customer\Events\Contracts;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

abstract class ProductCartEvent extends ShouldBeStored
{
    public function __construct($purchasableID, $purchasableType, $cartID)
    {
        
    }
}