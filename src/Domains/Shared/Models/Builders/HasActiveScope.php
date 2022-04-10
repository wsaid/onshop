<?php

namespace Domains\Shared\Models\Builders;

trait HasActiveScope {
    
    public function active() {
        return $this->where('active', true);
    }

    public function inactive() {
        return $this->where('active', false);
    }
}