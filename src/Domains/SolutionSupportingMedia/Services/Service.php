<?php

declare(strict_types=1);

namespace Domains\SolutionSupportingMedia\Services;

use Domains\SolutionSupportingMedia\Entities\Entity;
use Domains\SolutionSupportingMedia\Models\SolutionSupportingMedia;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate(model: $model, expectedModel: Entity::class);

        /** @var SolutionSupportingMedia $model */
        return Entity::fromEloquent(supportingMedia: $model);
    }
}
