<?php

declare(strict_types=1);

namespace Domains\SupportingMedia\Observers;

use Domains\SupportingMedia\Entities\Entity;
use Domains\SupportingMedia\Events\Created;
use Domains\SupportingMedia\Models\SupportingMedia;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(SupportingMedia $supportingMedia): void
    {
        $this->event->dispatch(
            event: new Created(
                entity: Entity::fromEloquent(
                    supportingMedia: $supportingMedia
                )
            )
        );
    }
}
