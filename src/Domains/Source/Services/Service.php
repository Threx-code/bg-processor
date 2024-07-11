<?php

declare(strict_types=1);

namespace Domains\Source\Services;

use Domains\Source\Entities\Entity;
use Domains\Source\Models\Source;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate(model: $model, expectedModel: Entity::class);

        /** @var Source $model */
        return Entity::fromEloquent(source: $model);
    }
}
