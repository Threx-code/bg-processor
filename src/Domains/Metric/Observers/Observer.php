<?php

declare(strict_types=1);

namespace Domains\Metric\Observers;

use Domains\Metric\Entities\Entity;
use Domains\Metric\Events\Created;
use Domains\Metric\Models\Metric;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(Metric $metric): void
    {
        $this->event->dispatch(
            event: new Created(
                entity: Entity::fromEloquent(
                    metric: $metric
                )
            )
        );
    }
}
