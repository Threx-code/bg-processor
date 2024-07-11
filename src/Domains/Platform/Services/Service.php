<?php

declare(strict_types=1);

namespace Domains\Platform\Services;

use Domains\Platform\Entities\Entity;
use Domains\Platform\Models\Platform;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate($model, Entity::class);

        /** @var Platform $model */
        return Entity::fromEloquent(platform: $model);
    }
}
