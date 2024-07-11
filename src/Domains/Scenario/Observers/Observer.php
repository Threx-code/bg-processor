<?php

declare(strict_types=1);

namespace Domains\Scenario\Observers;

use Domains\Scenario\Entities\Entity;
use Domains\Scenario\Events\Created;
use Domains\Scenario\Models\Scenario;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(Scenario $scenario): void
    {
        $this->event->dispatch(
            event: new Created(
                entity: Entity::fromEloquent(
                    scenario: $scenario
                )
            )
        );
    }
}
