<?php

declare(strict_types=1);

namespace Domains\Adp\Observers;

use Domains\Credit\Entities\Entity;
use Domains\Credit\Events\Created;
use Domains\Adp\Models\Adp;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(Adp $adp): void
    {
        $this->event->dispatch(
            event: new Created(
                commit: Entity::fromEloquent(
                    adp: $adp
                )
            )
        );
    }
}
