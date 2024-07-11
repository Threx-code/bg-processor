<?php

declare(strict_types=1);

namespace Domains\Metric\Services;

use Domains\Metric\Entities\Entity;
use Domains\Metric\Models\Metric;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate(model: $model, expectedModel: Entity::class);

        /** @var Metric $model */
        return Entity::fromEloquent(metric: $model);
    }
}
