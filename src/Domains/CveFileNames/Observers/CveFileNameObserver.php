<?php declare(strict_types=1);

namespace Domains\CveFileNames\Observers;

use Domains\CveFileNames\Entities\CveFileNameEntity;
use Domains\CveFileNames\Events\CveFileNameCreated;
use Domains\CveFileNames\Models\CveFileNames;
use Illuminate\Events\Dispatcher;

readonly class CveFileNameObserver
{
    public function __construct(
        private Dispatcher $event
    ){}

    public function created(CveFileNames $cveFileNames): void
    {
        $this->event->dispatch(
            event: new CveFileNameCreated(
                entity:  CveFileNameEntity::fromEloquent(
                    cveFileNames: $cveFileNames
                )
            )
        );
    }
}
