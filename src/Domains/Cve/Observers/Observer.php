<?php

declare(strict_types=1);

namespace Domains\Cve\Observers;

use Domains\Cve\Entities\Entity;
use Domains\Cve\Events\Created;
use Domains\Cve\Models\Cve;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(Cve $cve): void
    {
        $this->event->dispatch(
            event: new Created(
                commit: Entity::fromEloquent(
                    cve: $cve
                )
            )
        );
    }
}
