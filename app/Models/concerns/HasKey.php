<?php declare(strict_types=1);

namespace App\Models\concerns;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

trait HasKey
{
    public static function bootHasKey(): void
    {
        static::creating(function(Model $model) {
            $model->key = Str::uuid()->toString();
        });
    }
}
