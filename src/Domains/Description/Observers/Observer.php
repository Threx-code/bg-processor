<?php

declare(strict_types=1);

namespace Domains\Description\Observers;

use Domains\Description\Entities\Entity;
use Domains\Description\Events\Created;
use Domains\Description\Models\Description;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(Description $description): void
    {
        $this->event->dispatch(
            event: new Created(
                entity: Entity::fromEloquent(
                    description: $description
                )
            )
        );
    }
}
