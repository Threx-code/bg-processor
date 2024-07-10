<?php

declare(strict_types=1);

namespace Domains\VersionChange\Services;

use Domains\VersionChange\Entities\Entity;
use Domains\VersionChange\Models\VersionChange;
use Domains\Workaround\Models\Workaround;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate($model, Entity::class);

        /** @var VersionChange $model */
        return Entity::fromEloquent($model);
    }
}
