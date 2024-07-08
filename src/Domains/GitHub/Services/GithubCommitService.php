<?php

declare(strict_types=1);

namespace Domains\GitHub\Services;

use Domains\GitHub\Entities\GitHubCommitEntity;
use Domains\GitHub\Models\GithubCommit;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;
use Illuminate\Database\Eloquent\Model;

final class GithubCommitService extends BaseService
{
    protected function mapToEntity(Model $model): GitHubCommitEntity
    {
        ModelValidator::validate(model: $model, expectedModel: GithubCommit::class);

        /** @var GithubCommit $model */
        return GitHubCommitEntity::fromEloquent(commit: $model);

    }
}
