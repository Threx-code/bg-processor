<?php

declare(strict_types=1);

namespace Domains\AffectedProduct\Events;

use Domains\Credit\Entities\Entity;
use Infrastructures\Events\DomainEvent;

final class Event extends DomainEvent
{
    public function __construct(
        public readonly Entity $commit
    ) {}
}
