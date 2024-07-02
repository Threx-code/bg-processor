<?php declare(strict_types=1);

namespace Domains\GitHub\Entities;

use App\Models\Github\GithubCommit;
use Domains\GitHub\ValueObjects\GithubCommitObject;
use Infrastructures\Entities\DomainEntity;

final class GitHubCommitEntity extends DomainEntity
{
    public function __construct(
        public GithubCommitObject $commit_date,
        public null|string $key = null,
        public null|int $id = null
    ){}

    public static function fromEloquent(GithubCommit $commit): GitHubCommitEntity
    {
        return new GitHubCommitEntity(
            commit_date: $commit->commit_date,
            key: $commit->key,
            id: $commit->id

        );
    }

    public function toArray(): array
    {
        return [
            'commit_date' => $this->commit_date
        ];
    }
}
