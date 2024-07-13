<?php

declare(strict_types=1);

namespace Domains\GitHubCommit\Services;

use Domains\GitHubCommit\Entities\Entity;
use Domains\GitHubCommit\Models\GithubCommit;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;
use Illuminate\Database\Eloquent\Model;

final class Service extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate(model: $model, expectedModel: GithubCommit::class);

        /** @var GithubCommit $model */
        return Entity::fromEloquent(commit: $model);

    }
}
