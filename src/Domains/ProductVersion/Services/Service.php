<?php

declare(strict_types=1);

namespace Domains\ProductVersion\Services;

use Domains\Reference\Entities\Entity;
use Domains\Reference\Models\Reference;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate($model, Entity::class);

        /** @var Reference $model */
        return Entity::fromEloquent($model);
    }
}
