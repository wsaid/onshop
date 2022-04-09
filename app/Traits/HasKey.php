<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasKey
{

    public static function bootHasKey()
    {
        static::creating(function (Model $model) {
            $model->key = substr(strtolower(class_basename($model)), 0, 3) . '_' . Str::random(20);
        });
    }
}
