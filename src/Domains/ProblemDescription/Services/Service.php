<?php

declare(strict_types=1);

namespace Domains\ProblemDescription\Services;

use Domains\ProblemDescription\Entities\Entity;
use Domains\ProblemDescription\Models\ProblemDescription;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate(model: $model, expectedModel: Entity::class);

        /** @var ProblemDescription $model */
        return Entity::fromEloquent(description: $model);
    }
}
