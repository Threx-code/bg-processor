<?php

declare(strict_types=1);

namespace Domains\Adp\Services;

use Domains\Adp\Entities\AdpEntity;
use Domains\Adp\Models\Adp;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class AdpService extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate(model: $model, expectedModel: Adp::class);

        /** @var Adp $model */
        return AdpEntity::fromEloquent(adp: $model);
    }
}
