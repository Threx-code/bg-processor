<?php declare(strict_types=1);

namespace Domains\Adp\Casts;

use Carbon\Carbon;
use Domains\Adp\ValueObjects\DateUpdatedObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class Date implements CastsAttributes
{
    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return DateUpdatedObject
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): DateUpdatedObject
    {
        return new DateUpdatedObject(
            dateUpdated: Carbon::parse($value)->toDateTimeImmutable()
        );
    }

    /**
     * Prepare the given value for storage.
     *
     * @param  array<string, mixed>  $attributes
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): mixed
    {
        return (string)$value;
    }
}
