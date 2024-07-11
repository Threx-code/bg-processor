<?php

declare(strict_types=1);

namespace Domains\Description\Services;

use Domains\Description\Entities\Entity;
use Domains\Description\Models\Description;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate($model, Entity::class);

        /** @var Description $model */
        return Entity::fromEloquent($model);
    }
}
