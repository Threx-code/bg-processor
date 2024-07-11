<?php

declare(strict_types=1);

namespace Domains\Platform\Observers;

use Domains\Platform\Entities\Entity;
use Domains\Platform\Events\Created;
use Domains\Platform\Models\Platform;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(Platform $platform): void
    {
        $this->event->dispatch(
            event: new Created(
                entity: Entity::fromEloquent(
                    platform: $platform
                )
            )
        );
    }
}
