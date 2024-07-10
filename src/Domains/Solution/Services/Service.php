<?php

declare(strict_types=1);

namespace Domains\Solution\Services;

use Domains\Solution\Entities\Entity;
use Domains\Solution\Models\Solution;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate($model, Entity::class);

        /** @var Solution $model */
        return Entity::fromEloquent($model);
    }
}
