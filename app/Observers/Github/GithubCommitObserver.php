<?php declare(strict_types=1);

namespace App\Observers\Github;

use App\Models\Github\GithubCommit;
use Domains\GitHub\Entities\GitHubCommitEntity;
use Domains\GitHub\Events\GitHubCommitCreated;
use Illuminate\Events\Dispatcher;

readonly class GithubCommitObserver
{
    public function __construct(
        private Dispatcher $event
    ){}

    public function created(GithubCommit $commit): void
    {
        $this->event->dispatch(
            event: new GithubCommitCreated(
                commit:  GithubCommitEntity::fromEloquent(
                    commit: $commit
                )
            )
        );
    }
}
