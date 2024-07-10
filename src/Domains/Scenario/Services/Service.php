<?php

declare(strict_types=1);

namespace Domains\CveFileNames\Services;

use Domains\CveFileNames\Entities\Entity;
use Domains\CveFileNames\Models\CveFileNames;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate($model, Entity::class);

        /** @var CveFileNames $model */
        return Entity::fromEloquent($model);
    }
}
