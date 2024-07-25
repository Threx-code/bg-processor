<?php declare(strict_types=1);

namespace Domains\Cna\Events;

use Domains\Cna\Entities\Entity;
use Infrastructures\Events\DomainEvent;

final class Created extends DomainEvent
{
    public function __construct(public readonly Entity $entity) {}
}
