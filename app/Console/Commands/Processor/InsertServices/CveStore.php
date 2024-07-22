<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor\InsertServices;

use Domains\Cve\Entities\Entity;
use Domains\Cve\Models\Cve;
use Domains\Cve\Repositories\Repository;
use Domains\Cve\Services\Service as CveService;
use Domains\Helpers\ValueObjects\DateObject;
use Illuminate\Database\DatabaseManager;
use Infrastructures\Entities\DomainEntity;

class CveStore
{
    public static function process(array $data): DomainEntity
    {
        $service =
            new CveService(
                repository: new Repository(
                    query: Cve::query(),
                    database: resolve(
                        name: DatabaseManager::class
                    )
                )
            );

        return $service->create(
            entity: new Entity(
                cveId: $data['cveId'],
                title: $data['title'],
                state: $data['state'],
                assignerShortName: $data['assignerShortName'],
                dateReserved: new DateObject(
                    date: $data['dateReserved']
                ),
                datePublished: new DateObject(
                    date: $data['datePublished']
                ),
                dateUpdated: new DateObject(
                    date: $data['dateUpdated']
                )
            )
        );
    }
}
