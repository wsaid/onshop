<?php

namespace Domains\Customer\Factories;

use Domains\Customer\ValueObjects\CartValueObject;

class CartFactory {

    public static function make(array $attribute)
    {
        return new CartValueObject(
            $attribute['status'],
            $attribute['userID']
        );
    }
}