<?php declare(strict_types=1);

namespace Domains\Cve\Events;

use Domains\Cve\Entities\CveEntity;
use Infrastructures\Events\DomainEvent;

final class CveCreated extends DomainEvent
{
    public function __construct(public readonly CveEntity $commit){}
}
