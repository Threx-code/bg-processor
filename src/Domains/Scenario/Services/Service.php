<?php

declare(strict_types=1);

namespace Domains\Scenario\Services;

use Domains\Scenario\Entities\Entity;
use Domains\Scenario\Models\Scenario;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate(model: $model, expectedModel: Entity::class);

        /** @var Scenario $model */
        return Entity::fromEloquent(scenario: $model);
    }
}
