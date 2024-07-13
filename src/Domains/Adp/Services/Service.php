<?php

declare(strict_types=1);

namespace Domains\Adp\Services;

use Domains\Adp\Entities\Entity;
use Domains\Adp\Models\Adp;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): Entity
    {
        ModelValidator::validate(model: $model, expectedModel: Adp::class);

        /** @var Adp $model */
        return Entity::fromEloquent(adp: $model);
    }
}
