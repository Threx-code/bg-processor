<?php declare(strict_types=1);

namespace Domains\Description\Events;

use Domains\Description\Entities\Entity;
use Infrastructures\Events\DomainEvent;

final class Created extends DomainEvent
{
    public function __construct(public readonly Entity $entity) {}
}
