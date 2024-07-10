<?php

declare(strict_types=1);

namespace Domains\Source\Observers;

use Domains\Source\Entities\Entity;
use Domains\Source\Events\Created;
use Domains\Source\Models\Source;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(Source $cveFileNames): void
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
