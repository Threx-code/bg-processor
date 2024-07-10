<?php

declare(strict_types=1);

namespace Domains\Workaround\Observers;

use Domains\Workaround\Entities\Entity;
use Domains\Workaround\Events\Created;
use Domains\Workaround\Models\Workaround;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(Workaround $cveFileNames): void
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
