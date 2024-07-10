<?php declare(strict_types=1);

namespace Domains\AdpMetrics\Events;

use Domains\AdpMetrics\Entities\Entity;
use Infrastructures\Events\DomainEvent;

final class Event extends DomainEvent
{
    public function __construct(
        public readonly Entity $entity
    ) {}
}
