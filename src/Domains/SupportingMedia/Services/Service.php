<?php

declare(strict_types=1);

namespace Domains\SupportingMedia\Services;

use Domains\SupportingMedia\Entities\Entity;
use Domains\SupportingMedia\Models\SupportingMedia;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate(model: $model, expectedModel: Entity::class);

        /** @var SupportingMedia $model */
        return Entity::fromEloquent(supportingMedia: $model);
    }
}
