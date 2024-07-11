<?php

declare(strict_types=1);

namespace Domains\ProblemType\Observers;

use Domains\ProblemType\Entities\Entity;
use Domains\ProblemType\Events\Created;
use Domains\ProblemType\Models\ProblemType;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(ProblemType $type): void
    {
        $this->event->dispatch(
            event: new Created(
                entity: Entity::fromEloquent(
                    type: $type
                )
            )
        );
    }
}
