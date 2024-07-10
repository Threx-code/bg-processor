<?php

declare(strict_types=1);

namespace Domains\Timeline\Services;

use Domains\Timeline\Entities\Entity;
use Domains\Timeline\Models\Timeline;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate($model, Entity::class);

        /** @var Timeline $model */
        return Entity::fromEloquent($model);
    }
}
