<?php

declare(strict_types=1);

namespace Domains\CvssV3\Observers;

use Domains\CvssV3\Entities\Entity;
use Domains\CvssV3\Events\Created;
use Domains\CvssV3\Models\CvssV3;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(CvssV3 $cvssV3): void
    {
        $this->event->dispatch(
            event: new Created(
                entity: Entity::fromEloquent(
                    cvssV3: $cvssV3
                )
            )
        );
    }
}
