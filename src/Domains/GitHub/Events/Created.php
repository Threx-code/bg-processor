<?php

declare(strict_types=1);

namespace Domains\GitHub\Events;

use Domains\GitHub\Entities\Entity;
use Infrastructures\Events\DomainEvent;

final class Created extends DomainEvent
{
    public function __construct(
        public readonly Entity $commit
    ) {}
}
