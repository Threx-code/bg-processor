<?php

declare(strict_types=1);

namespace Domains\AffectedProduct\Observers;

use Domains\AffectedProduct\Entities\Entity;
use Domains\AffectedProduct\Events\Created;
use Domains\AffectedProduct\Models\AffectedProduct;
use Illuminate\Events\Dispatcher;

readonly class Observer
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(AffectedProduct $product): void
    {
        $this->event->dispatch(
            event: new Created(
                commit: Entity::fromEloquent(
                    product: $product
                )
            )
        );
    }
}
