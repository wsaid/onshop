<?php

namespace Domains\Customer\Events;

use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

final class CouponRemoved extends ShouldBeStored {

    public int $cartID;
    public string $code;

    public function __construct($cartID, $code)
    {
        $this->cartID = $cartID;
        $this->code = $code;
    }
}