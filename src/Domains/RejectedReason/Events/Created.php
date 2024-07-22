<?php

declare(strict_types=1);

namespace Domains\RejectedReason\Events;

use Domains\RejectedReason\Entities\Entity;
use Infrastructures\Events\DomainEvent;

final class Created extends DomainEvent
{
    public function __construct(
        public readonly Entity $rejectedReason
    ) {}
}
