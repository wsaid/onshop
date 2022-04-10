<?php

namespace Domains\Catalog\Models;

use Domains\Shared\Models\Builders\HasActiveScope;
use Illuminate\Database\Eloquent\Builder;

class RangeBuilder extends Builder
{
    use HasActiveScope;   
}