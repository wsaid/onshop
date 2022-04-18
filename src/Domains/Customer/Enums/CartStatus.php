<?php

namespace Domains\Customer\Enums;

use Spatie\Enum\Laravel\Enum;

/**
 * @method static self PENDING()
 * @method static self COMPLETED()
 * @method static self ABANDONED()
 */
class CartStatus extends Enum {}