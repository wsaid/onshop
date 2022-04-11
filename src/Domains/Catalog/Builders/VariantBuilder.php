<?php

namespace Domains\Catalog\Builders;

use Domains\Shared\Models\Builders\HasActiveScope;
use Illuminate\Database\Eloquent\Builder;

class VariantBuilder extends Builder
{
    use HasActiveScope;

    public function shippable() 
    {
        return $this->where('shippable', true);
    }

    public function digital() 
    {
        return $this->where('shippable', false);
    }
}