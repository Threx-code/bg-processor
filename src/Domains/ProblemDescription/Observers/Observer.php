<?php

declare(strict_types=1);

namespace Domains\ProblemDescription\Observers;

use Domains\ProblemDescription\Entities\Entity;
use Domains\ProblemDescription\Events\Created;
use Domains\CveFileNames\Models\CveFileNames;
use Domains\ProblemDescription\Models\ProblemDescription;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(ProblemDescription $description): void
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
