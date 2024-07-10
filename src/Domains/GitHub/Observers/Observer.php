<?php

declare(strict_types=1);

namespace Domains\GitHub\Observers;

use Domains\GitHub\Entities\Entity;
use Domains\GitHub\Events\Created;
use Domains\GitHub\Models\GithubCommit;
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
