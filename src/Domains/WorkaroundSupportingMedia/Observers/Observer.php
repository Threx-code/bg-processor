<?php

declare(strict_types=1);

namespace Domains\WorkaroundSupportingMedia\Observers;

use Domains\WorkaroundSupportingMedia\Entities\Entity;
use Domains\WorkaroundSupportingMedia\Events\Created;
use Domains\WorkaroundSupportingMedia\Models\WorkaroundSupportingMedia;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(WorkaroundSupportingMedia $cveFileNames): void
    {
        $this->event->dispatch(
            event: new Created(
                entity: Entity::fromEloquent(
                    cveFileNames: $cveFileNames
                )
            )
        );
    }
}
