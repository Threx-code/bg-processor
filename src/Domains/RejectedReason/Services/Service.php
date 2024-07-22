<?php

declare(strict_types=1);

namespace Domains\RejectedReason\Services;

use Domains\RejectedReason\Entities\Entity;
use Domains\RejectedReason\Models\RejectedReason;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): Entity
    {
        ModelValidator::validate(model: $model, expectedModel: RejectedReason::class);

        /** @var RejectedReason $model */
        return Entity::fromEloquent(reason: $model);
    }
}
