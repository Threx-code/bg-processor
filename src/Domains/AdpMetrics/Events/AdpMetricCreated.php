<?php declare(strict_types=1);

namespace Domains\GitHub\Events;

use Domains\AdpMetrics\Entities\AdpMetricsEntity;
use Infrastructures\Events\DomainEvent;

final class AdpMetricCreated extends DomainEvent
{
    public function __construct(
        public readonly AdpMetricsEntity $commit
    ){}
}
