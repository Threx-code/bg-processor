<?php declare(strict_types=1);

namespace Domains\Reference\Events;

use Domains\Reference\Entities\Entity;
use Infrastructures\Events\DomainEvent;

final class Created extends DomainEvent
{
    public function __construct(public readonly Entity $entity) {}
}
