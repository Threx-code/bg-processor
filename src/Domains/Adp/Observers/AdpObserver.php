<?php declare(strict_types=1);

namespace Domains\Adp\Observers;

use Domains\Adp\Entities\AdpEntity;
use Domains\Adp\Models\Adp;
use Domains\Adp\Events\AdpCreated;
use Illuminate\Events\Dispatcher;

readonly class AdpObserver
{
    public function __construct(
        private Dispatcher $event
    ){}

    public function created(Adp $commit): void
    {
        $this->event->dispatch(
            event: new AdpCreated(
                commit:  AdpEntity::fromEloquent(
                    commit: $commit
                )
            )
        );
    }
}
