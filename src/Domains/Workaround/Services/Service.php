<?php

declare(strict_types=1);

namespace Domains\Workaround\Services;

use Domains\Workaround\Entities\Entity;
use Domains\Workaround\Models\Workaround;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate(model: $model, expectedModel: Entity::class);

        /** @var Workaround $model */
        return Entity::fromEloquent(workaround: $model);
    }
}
