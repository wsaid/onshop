<?php

namespace Domains\Customer\Events\Contracts;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

abstract class ProductCartEvent extends ShouldBeStored
{
    public $cartID;
    public $purchasableID;
    public $purchasableType;
    
    public function __construct($cartID, $purchasableID, $purchasableType)
    {
        $this->cartID = $cartID;
        $this->purchasableID = $purchasableID;
        $this->purchasableType = $purchasableType;
    }
}