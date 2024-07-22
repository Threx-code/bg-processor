<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor;

use Illuminate\Database\DatabaseManager;
use Infrastructures\Entities\DomainEntity;

final readonly class BaseProcessor
{
    public function __construct(
        private string $entity,
        private string $repository,
        private string $service
    ) {}

    public function process(array $data): DomainEntity
    {
        $service =
            new $this->service(
                repository: new $this->repository(
                    query: $this->entity::query(),
                    database: resolve(
                        name: DatabaseManager::class
                    )
                )
            );

        return $service->create(
            entity: new $this->entity(
                ...$data
            )
        );
    }
}
