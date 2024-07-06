<?php declare(strict_types=1);

namespace Domains\GitHub\Entities;

use Domains\GitHub\Models\GithubCommit;
use Domains\GitHub\ValueObjects\GithubCommitObject;
use Infrastructures\Entities\DomainEntity;

final class GitHubCommitEntity extends DomainEntity
{
    public function __construct(
        public GithubCommitObject $commitDate,
        public null|string $key = null,
        public null|int $id = null
    ){}

    public static function fromEloquent(GithubCommit $commit): GitHubCommitEntity
    {
        return new GitHubCommitEntity(
            commitDate: $commit->commitDate,
            key: $commit->key,
            id: $commit->id

        );
    }

    public function toArray(): array
    {
        return [
            'commitDate' => $this->commitDate
        ];
    }
}
