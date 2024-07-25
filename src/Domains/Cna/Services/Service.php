<?php

declare(strict_types=1);

namespace Domains\Cna\Services;

use Domains\Cna\Entities\Entity;
use Domains\Cna\Models\Cna;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate(model: $model, expectedModel: Entity::class);

        /** @var Cna $model */
        return Entity::fromEloquent(cna: $model);
    }
}
