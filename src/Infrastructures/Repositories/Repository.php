<?php

declare(strict_types=1);

namespace Infrastructures\Repositories;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Infrastructures\Entities\DomainEntity;
use Throwable;

abstract class Repository implements RepositoryInterface
{
    public function __construct(
        private readonly Builder $query,
        private readonly DatabaseManager $database
    ) {}

    public function all(): Collection
    {
        return $this->query->get();
    }

    public function find(string|int $key, array $with = []): ?object
    {
        return $this->query->with(
            relations: $with
        )->findOrFail(
            id: $key
        );
    }

    /**
     * @param DomainEntity $entity
     * @return DomainEntity
     * @throws Throwable
     */
    public function create(DomainEntity $entity): DomainEntity
    {
        return $this->database->transaction(
            callback: fn () => $this->query->create(
                attributes: $entity->toArray()
            ),
            attempts: 3
        );
    }

    /**
     * @param string|int $key
     * @param DomainEntity $entity
     * @return DomainEntity
     * @throws Throwable
     */
    public function update(string|int $key, DomainEntity $entity): DomainEntity
    {
        return $this->database->transaction(
            callback: function () use ($key, $entity) {
                $this->query->where('key', $key)->first()->update($entity->toArray());
            },
            attempts: 3
        );
    }

    /**
     * @throws Throwable
     */
    public function delete(string|int $key): void
    {
        $this->database->transaction(
            callback: fn () => $this->query->findOrFail(
                id: $key
            )->delete(),
            attempts: 3
        );
    }
}
