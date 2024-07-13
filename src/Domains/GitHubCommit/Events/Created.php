<?php

declare(strict_types=1);

namespace Domains\GitHubCommit\Events;

use Domains\GitHubCommit\Entities\Entity;
use Infrastructures\Events\DomainEvent;

final class Created extends DomainEvent
{
    public function __construct(
        public readonly Entity $commit
    ) {}
}
