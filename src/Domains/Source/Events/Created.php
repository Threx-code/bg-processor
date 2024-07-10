<?php declare(strict_types=1);

namespace Domains\Source\Events;

use Domains\Source\Entities\Entity;
use Infrastructures\Events\DomainEvent;

final class Created extends DomainEvent
{
    public function __construct(public readonly Entity $entity) {}
}
