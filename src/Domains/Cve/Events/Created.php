<?php declare(strict_types=1);

namespace Domains\Cve\Events;

use Domains\Cve\Entities\Entity;
use Infrastructures\Events\DomainEvent;

final class Created extends DomainEvent
{
    public function __construct(public readonly Entity $commit) {}
}
