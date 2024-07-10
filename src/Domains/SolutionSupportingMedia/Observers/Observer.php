<?php

declare(strict_types=1);

namespace Domains\SolutionSupportingMedia\Observers;

use Domains\SolutionSupportingMedia\Entities\Entity;
use Domains\SolutionSupportingMedia\Events\Created;
use Domains\SolutionSupportingMedia\Models\SolutionSupportingMedia;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(SolutionSupportingMedia $cveFileNames): void
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
