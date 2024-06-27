<?php declare(strict_types=1);

namespace Domains\GitHub\Entities;

use App\Models\GithubCommit;

final class GitHubCommitEntity
{
    public function __construct(
        public string $commit_date
    ){}

    public static function fromEloquent(GithubCommit $commit): GitHubCommitEntity
    {
        return new GitHubCommitEntity(
            commit_date: $commit->commit_date
        );
    }
}
