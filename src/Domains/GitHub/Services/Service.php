<?php

declare(strict_types=1);

namespace Domains\GitHub\Services;

use Domains\GitHub\Entities\Entity;
use Domains\GitHub\Models\GithubCommit;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;
use Illuminate\Database\Eloquent\Model;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): Entity
    {
        ModelValidator::validate(model: $model, expectedModel: GithubCommit::class);

        /** @var GithubCommit $model */
        return Entity::fromEloquent(commit: $model);

    }
}
