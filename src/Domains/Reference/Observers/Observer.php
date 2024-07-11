<?php

declare(strict_types=1);

namespace Domains\Reference\Observers;

use Domains\Reference\Entities\Entity;
use Domains\Reference\Events\Created;
use Domains\Reference\Models\Reference;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(Reference $cveFileNames): void
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
