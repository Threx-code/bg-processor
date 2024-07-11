<?php

declare(strict_types=1);

namespace Domains\AffectedProduct\Services;

use Domains\AffectedProduct\Models\AffectedProduct;
use Domains\AffectedProduct\Entities\Entity;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): Entity
    {
        ModelValidator::validate(model: $model, expectedModel: AffectedProduct::class);

        /** @var AffectedProduct $model */
        return Entity::fromEloquent(product: $model);
    }
}
