<?php

declare(strict_types=1);

namespace Domains\Helpers\Casts;

use Carbon\Carbon;
use Domains\Helpers\ValueObjects\DateObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class Date implements CastsAttributes
{
    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return DateObject
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): DateObject
    {
        return new DateObject(
            date: Carbon::parse($value)->toDateTimeImmutable()
        );
    }


    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return string
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): string
    {
        return (string) $value;
    }
}
