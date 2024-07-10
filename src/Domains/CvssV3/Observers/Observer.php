<?php

declare(strict_types=1);

namespace Domains\CveFileNames\Observers;

use Domains\CveFileNames\Entities\Entity;
use Domains\CveFileNames\Events\Created;
use Domains\CveFileNames\Models\CveFileNames;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(CveFileNames $cveFileNames): void
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
