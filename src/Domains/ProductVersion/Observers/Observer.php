<?php

declare(strict_types=1);

namespace Domains\ProductVersion\Observers;

use Domains\ProductVersion\Entities\Entity;
use Domains\ProductVersion\Events\Created;
use Domains\ProductVersion\Models\ProductVersion;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(ProductVersion $version): void
    {
        $this->event->dispatch(
            event: new Created(
                entity: Entity::fromEloquent(
                    version: $version
                )
            )
        );
    }
}
