<?php

declare(strict_types=1);

namespace Domains\Credit\Observers;

use Domains\Credit\Entities\Entity;
use Domains\Credit\Events\Created;
use Domains\Credit\Models\Credit;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(Credit $credit): void
    {
        $this->event->dispatch(
            event: new Created(
                commit: Entity::fromEloquent(
                    credit: $credit
                )
            )
        );
    }
}
