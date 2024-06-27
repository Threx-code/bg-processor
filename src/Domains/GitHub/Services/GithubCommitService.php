<?php declare(strict_types=1);

namespace Domains\GitHub\Services;

use App\Models\GithubCommit;
use Domains\GitHub\Entities\GitHubCommitEntity;
use Domains\GitHub\Repositories\GitHubCommitRepository;
use Illuminate\Database\Eloquent\Collection;

final readonly class GithubCommitService
{
    public function __construct(
        private GitHubCommitRepository $repository
    ){}

    public function all(): Collection
    {
        return $this->repository->all()->map(
            callback: fn(GithubCommit $commit): GitHubCommitEntity => GitHubCommitEntity::fromEloquent(
                commit: $commit
            )
        );
    }
}
