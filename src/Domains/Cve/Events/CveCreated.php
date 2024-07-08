<?php declare(strict_types=1);

namespace Domains\Cve\Events;

use Domains\Adp\Entities\AdpEntity;

use Infrastructures\Events\DomainEvent;

final class CveCreated extends DomainEvent
{
    public function __construct(public readonly AdpEntity $commit){}
}
