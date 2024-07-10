<?php

declare(strict_types=1);

namespace Domains\ProblemType\Services;

use Domains\ProblemType\Entities\Entity;
use Domains\ProblemType\Models\ProblemType;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate($model, Entity::class);

        /** @var ProblemType $model */
        return Entity::fromEloquent($model);
    }
}
