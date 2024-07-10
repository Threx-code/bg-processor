<?php

declare(strict_types=1);

namespace Domains\AdpMetrics\Services;

use Domains\AdpMetrics\Entities\Entity;
use Domains\AdpMetrics\Models\AdpMetric;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): Entity
    {
        ModelValidator::validate(model: $model, expectedModel: AdpMetric::class);

        /** @var AdpMetric $model */
        return Entity::fromEloquent(adpMetric: $model);
    }
}
