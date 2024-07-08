<?php

declare(strict_types=1);

namespace Domains\GitHub\Observers;

use Domains\GitHub\Entities\GitHubCommitEntity;
use Domains\GitHub\Events\GitHubCommitCreated;
use Domains\GitHub\Models\GithubCommit;
use Illuminate\Events\Dispatcher;

readonly class GithubCommitObserver
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(GithubCommit $commit): void
    {
        $this->event->dispatch(
            event: new GitHubCommitCreated(
                commit: GitHubCommitEntity::fromEloquent(
                    commit: $commit
                )
            )
        );
    }
}
