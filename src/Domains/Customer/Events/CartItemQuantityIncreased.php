<?php

namespace Domains\Customer\Events;

use Domains\Customer\Events\Contracts\CartItemQuantityEvent;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

final class CartItemQuantityIncreased extends ShouldBeStored {

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