<?php declare(strict_types=1);

namespace Domains\CvssV3\Events;

use Domains\CvssV3\Entities\Entity;
use Infrastructures\Events\DomainEvent;

final class Created extends DomainEvent
{
    public function __construct(public readonly Entity $entity) {}
}
