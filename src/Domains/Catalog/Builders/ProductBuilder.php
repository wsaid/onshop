<?php

namespace Domains\Catalog\Models;

use Domains\Shared\Models\Builders\HasActiveScope;
use Illuminate\Database\Eloquent\Builder;

class ProductBuilder extends Builder
{
    use HasActiveScope;
}