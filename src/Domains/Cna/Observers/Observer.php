<?php

declare(strict_types=1);

namespace Domains\Cna\Observers;

use Domains\Cna\Entities\Entity;
use Domains\Cna\Events\Created;
use Domains\Cna\Models\Cna;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(Cna $cna): void
    {
        $this->event->dispatch(
            event: new Created(
                entity: Entity::fromEloquent(
                    cna: $cna
                )
            )
        );
    }
}
