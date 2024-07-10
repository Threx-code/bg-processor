<?php

declare(strict_types=1);

namespace Domains\Solution\Observers;

use Domains\Solution\Entities\Entity;
use Domains\Solution\Events\Created;
use Domains\Solution\Models\Solution;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(Solution $cveFileNames): void
    {
        $this->event->dispatch(
            event: new Created(
                entity: Entity::fromEloquent(
                    cveFileNames: $cveFileNames
                )
            )
        );
    }
}
