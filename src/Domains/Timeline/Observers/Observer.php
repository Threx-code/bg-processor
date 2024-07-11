<?php

declare(strict_types=1);

namespace Domains\Timeline\Observers;

use Domains\Timeline\Entities\Entity;
use Domains\Timeline\Events\Created;
use Domains\Timeline\Models\Timeline;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(Timeline $timeline): void
    {
        $this->event->dispatch(
            event: new Created(
                entity: Entity::fromEloquent(
                    timeline: $timeline
                )
            )
        );
    }
}
