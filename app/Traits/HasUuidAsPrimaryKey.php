<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasUuidAsPrimaryKey
{
    protected static function boot()
    {
        parent::boot();

        static::creating(function (Model $model) {
            if (! $model->getAttribute($model->getKeyName())) {
                $model->setAttribute($model->getKeyName(), Str::uuid()->toString());
            }
        });
    }
}
