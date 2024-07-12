<?php

declare(strict_types=1);

namespace Domains\XGenerator\Observers;

use Domains\XGenerator\Entities\Entity;
use Domains\XGenerator\Events\Created;
use Domains\XGenerator\Models\XGenerator;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(XGenerator $generator): void
    {
        $this->event->dispatch(
            event: new Created(
                entity: Entity::fromEloquent(
                    generator: $generator
                )
            )
        );
    }
}
