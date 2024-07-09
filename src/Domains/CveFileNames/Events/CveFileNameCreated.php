<?php declare(strict_types=1);

namespace Domains\CveFileNames\Events;

use Domains\CveFileNames\Entities\CveFileNameEntity;
use Infrastructures\Events\DomainEvent;

final class CveFileNameCreated extends DomainEvent
{
    public function __construct(public readonly CveFileNameEntity $entity){}
}
