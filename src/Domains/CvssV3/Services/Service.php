<?php

declare(strict_types=1);

namespace Domains\CvssV3\Services;

use Domains\CvssV3\Entities\Entity;
use Domains\CvssV3\Models\CvssV3;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate(model: $model, expectedModel: Entity::class);

        /** @var CvssV3 $model */
        return Entity::fromEloquent(cvssV3: $model);
    }
}
