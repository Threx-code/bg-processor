<?php declare(strict_types=1);

namespace Domains\Cve\Observers;

use Domains\Adp\Entities\CveEntity;
use Domains\Adp\Models\Adp;
use Domains\Cve\Events\CveCreated;
use Illuminate\Events\Dispatcher;

readonly class CveObserver
{
    public function __construct(
        private Dispatcher $event
    ){}

    public function created(Adp $adp): void
    {
        $this->event->dispatch(
            event: new CveCreated(
                commit:  CveEntity::fromEloquent(
                    adp: $adp
                )
            )
        );
    }
}
