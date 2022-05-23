<?php

namespace Domains\Customer\Events;

use Domains\Customer\Events\Contracts\CartItemQuantityEvent;
use Spatie\EventSourcing\StoredEvents\ShouldBeStored;

final class CartItemQuantityIncreased extends CartItemQuantityEvent {}