<?php declare(strict_types=1);

namespace Domains\GitHub\Services;

use Domains\GitHub\Entities\GitHubCommitEntity;
use Domains\GitHub\Models\GithubCommit;
use Domains\GitHub\Repositories\GitHubCommitRepository;
use Illuminate\Support\Collection;
use Throwable;

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

    /**
     * @param GitHubCommitEntity $commit
     * @return void
     * @throws Throwable
     */
    public function create(GitHubCommitEntity $commit): void
    {
        $this->repository->create(entity: $commit);
    }

    /**
     * @param string $key
     * @param GitHubCommitEntity $commit
     * @return void
     * @throws Throwable
     */
    public function update(string $key, GitHubCommitEntity $commit): void
    {
        $this->repository->update(key: $key, entity: $commit);
    }
}
