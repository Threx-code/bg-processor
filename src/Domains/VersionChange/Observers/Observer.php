<?php

declare(strict_types=1);

namespace Domains\VersionChange\Observers;

use Domains\VersionChange\Entities\Entity;
use Domains\VersionChange\Events\Created;
use Domains\VersionChange\Models\VersionChange;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(VersionChange $change): void
    {
        $this->event->dispatch(
            event: new Created(
                entity: Entity::fromEloquent(
                    change: $change
                )
            )
        );
    }
}
