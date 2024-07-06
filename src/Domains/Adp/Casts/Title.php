<?php declare(strict_types=1);

namespace Domains\Adp\Casts;

use Domains\Adp\ValueObjects\TitleObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class Title implements CastsAttributes
{
    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return TitleObject
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): TitleObject
    {
        return new TitleObject(
            title: $value
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
        return (string)$value;
    }
}
