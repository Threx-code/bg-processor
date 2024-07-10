<?php declare(strict_types=1);

namespace Domains\Timeline\Events;

use Domains\Timeline\Entities\Entity;
use Infrastructures\Events\DomainEvent;

final class Created extends DomainEvent
{
    public function __construct(public readonly Entity $entity) {}
}
