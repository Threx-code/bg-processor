<?php

declare(strict_types=1);

namespace Domains\Credit\Events;

use Domains\Credit\Entities\Entity;
use Infrastructures\Events\DomainEvent;

final class Created extends DomainEvent
{
    public function __construct(
        public readonly Entity $commit
    ) {}
}
