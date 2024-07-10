<?php

declare(strict_types=1);

namespace Domains\XGenerator\Services;

use Domains\XGenerator\Entities\Entity;
use Domains\XGenerator\Models\XGenerator;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate($model, Entity::class);

        /** @var XGenerator $model */
        return Entity::fromEloquent($model);
    }
}
