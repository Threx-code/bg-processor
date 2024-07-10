<?php declare(strict_types=1);

namespace Domains\SolutionSupportingMedia\Events;

use Domains\SolutionSupportingMedia\Entities\Entity;
use Infrastructures\Events\DomainEvent;

final class Created extends DomainEvent
{
    public function __construct(public readonly Entity $entity) {}
}
