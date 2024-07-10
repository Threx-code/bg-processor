<?php

declare(strict_types=1);

namespace Domains\Cve\Services;

use Domains\Cve\Entities\Entity;
use Domains\Cve\Models\Cve;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate($model, Entity::class);

        /** @var Cve $model */
        return Entity::fromEloquent($model);
    }
}
