<?php declare(strict_types=1);

namespace Domains\Adp\Events;

use Domains\Adp\Entities\AdpEntity;

use Infrastructures\Events\DomainEvent;

final class AdpCreated extends DomainEvent
{
    public function __construct(public readonly AdpEntity $commit){}
}
