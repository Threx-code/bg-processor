<?php declare(strict_types=1);

namespace Domains\Helpers\Casts;

use Carbon\Carbon;
use Domains\Helpers\ValueObjects\DateObject;
use Domains\Helpers\ValueObjects\JsonObject;
use Illuminate\Contracts\Database\Eloquent\CastsAttributes;
use Illuminate\Database\Eloquent\Model;

class JsonData implements CastsAttributes
{

    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return JsonObject
     */
    public function get(Model $model, string $key, mixed $value, array $attributes): JsonObject
    {
        return new JsonObject(
            data: json_encode($value) ?? $value
        );
    }


    /**
     * @param Model $model
     * @param string $key
     * @param mixed $value
     * @param array $attributes
     * @return false|string
     */
    public function set(Model $model, string $key, mixed $value, array $attributes): false|string
    {
        return json_encode($value);
    }

}
