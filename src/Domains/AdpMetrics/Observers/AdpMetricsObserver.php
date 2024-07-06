<?php declare(strict_types=1);

namespace Domains\AdpMetrics\Observers;

use Domains\AdpMetrics\Entities\AdpMetricsEntity;
use Domains\AdpMetrics\Models\AdpMetrics;
use Domains\GitHub\Events\AdpMetricCreated;
use Illuminate\Events\Dispatcher;

readonly class AdpMetricsObserver
{
    public function __construct(
        private Dispatcher $event
    ){}

    public function created(AdpMetrics $metrics): void
    {
        $this->event->dispatch(
            event: new AdpMetricCreated(
                commit:  AdpMetricsEntity::fromEloquent(
                    metrics: $metrics
                )
            )
        );
    }
}
