<?php declare(strict_types=1);

namespace Infrastructures\Exceptions;

use Illuminate\Database\Eloquent\Model;
use InvalidArgumentException;

final readonly class ModelValidator
{
    public static function validate(Model $model, string $expectedModel): void
    {
        if (! $model instanceof $expectedModel) {
            throw new InvalidArgumentException(
                sprintf('Expected model %s, but got %s', $expectedModel, get_class($model))
            );
        }
    }
}
