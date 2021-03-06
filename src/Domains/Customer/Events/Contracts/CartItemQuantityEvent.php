<?php

namespace Domains\Customer\Events\Contracts;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

abstract class CartItemQuantityEvent extends ShouldBeStored
{
    public $cartID;
    public $cartItemID;
    public $quantity;

    public function __construct($cartID, $cartItemID, $quantity)
    {
        $this->cartID = $cartID;
        $this->cartItemID = $cartItemID;
        $this->quantity = $quantity;
    }
}