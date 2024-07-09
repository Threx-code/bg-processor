<?php declare(strict_types=1);

namespace Domains\Cve\Observers;

use Domains\Cve\Entities\CveEntity;
use Domains\Cve\Events\CveCreated;
use Domains\Cve\Models\Cve;
use Illuminate\Events\Dispatcher;

readonly class CveObserver
{
    public function __construct(
        private Dispatcher $event
    ){}

    public function created(Cve $cve): void
    {
        $this->event->dispatch(
            event: new CveCreated(
                commit:  CveEntity::fromEloquent(
                    cve: $cve
                )
            )
        );
    }
}
