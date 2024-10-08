<?php

declare(strict_types=1);

namespace Domains\Adp\Observers;

use Domains\Adp\Entities\Entity;
use Domains\Adp\Events\Created;
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
                entity: Entity::fromEloquent(
                    adp: $adp
                )
            )
        );
    }
}
