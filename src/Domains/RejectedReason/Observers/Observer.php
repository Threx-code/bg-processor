<?php

declare(strict_types=1);

namespace Domains\RejectedReason\Observers;

use Domains\RejectedReason\Entities\Entity;
use Domains\RejectedReason\Events\Created;
use Domains\RejectedReason\Models\RejectedReason;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(RejectedReason $reason): void
    {
        $this->event->dispatch(
            event: new Created(
                rejectedReason: Entity::fromEloquent(
                    reason: $reason
                )
            )
        );
    }
}
