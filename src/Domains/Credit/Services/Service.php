<?php

declare(strict_types=1);

namespace Domains\Credit\Services;

use Domains\Credit\Entities\Entity;
use Domains\Credit\Models\Credit;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): Entity
    {
        ModelValidator::validate(model: $model, expectedModel: Credit::class);

        /** @var Credit $model */
        return Entity::fromEloquent(credit: $model);
    }
}
