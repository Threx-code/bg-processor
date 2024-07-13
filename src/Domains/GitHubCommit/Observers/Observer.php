<?php

declare(strict_types=1);

namespace Domains\GitHubCommit\Observers;

use Domains\GitHubCommit\Entities\Entity;
use Domains\GitHubCommit\Events\Created;
use Domains\GitHubCommit\Models\GithubCommit;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(GithubCommit $commit): void
    {
        $this->event->dispatch(
            event: new Created(
                commit: Entity::fromEloquent(
                    commit: $commit
                )
            )
        );
    }
}
