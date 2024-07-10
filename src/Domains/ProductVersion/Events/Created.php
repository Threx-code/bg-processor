<?php declare(strict_types=1);

namespace Domains\ProductVersion\Events;

use Domains\ProductVersion\Entities\Entity;
use Infrastructures\Events\DomainEvent;

final class Created extends DomainEvent
{
    public function __construct(public readonly Entity $entity) {}
}
