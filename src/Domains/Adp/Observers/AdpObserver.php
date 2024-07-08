<?php

declare(strict_types=1);

namespace Domains\Adp\Observers;

use Domains\Adp\Entities\AdpEntity;
use Domains\Adp\Events\AdpCreatedEvent;
use Domains\Adp\Models\Adp;
use Illuminate\Events\Dispatcher;

readonly class AdpObserver
{
    public function __construct(
        private Dispatcher $event
    ) {}

    public function created(Adp $adp): void
    {
        $this->event->dispatch(
            event: new AdpCreatedEvent(
                commit: AdpEntity::fromEloquent(
                    adp: $adp
                )
            )
        );
    }
}
