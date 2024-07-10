<?php

declare(strict_types=1);

namespace Domains\AdpMetrics\Observers;

use Domains\AdpMetrics\Entities\Entity;
use Domains\AdpMetrics\Events\Event;
use Domains\AdpMetrics\Models\AdpMetric;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(AdpMetric $metric): void
    {
        $this->event->dispatch(
            event: new Event(
                entity: Entity::fromEloquent(
                    adpMetric: $metric
                )));
    }
}
