<?php declare(strict_types=1);

namespace Infrastructures\Repositories;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Infrastructures\Entities\DomainEntity;
use Throwable;

abstract class Repository implements RepositoryInterface
{
    /**
     * @param Builder $query
     * @param DatabaseManager $database
     */
    public function __construct(
        private readonly Builder $query,
        private readonly DatabaseManager $database
    ){}

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->query->get();
    }

    /**
     * @param string|int $key
     * @param array $with
     * @return object|null
     */
    public function find(string|int $key, array $with = []): null|object
    {
        return $this->query->with(
            relations: $with
        )->findOrFail(
            id: $key
        );
    }

    /**
     * @param DomainEntity $entity
     * @return void
     * @throws Throwable
     */
    public function create(DomainEntity $entity): void
    {
        $this->database->transaction(
            callback: fn() => $this->query->create(
                attributes: $entity->toArray()
            ),
            attempts: 3
        );
    }

    /**
     * @param string|int $key
     * @param DomainEntity $entity
     * @return void
     * @throws Throwable
     */
    public function update(string|int $key, DomainEntity $entity): void
    {
        $this->database->transaction(
            callback: fn() => $this->query->where(
                column: 'key',
                value: $key
            )->first()->update(
                attributes: $entity->toArray()
            ),
            attempts: 3
        );
    }

    /**
     * @param string|int $key
     * @return void
     * @throws Throwable
     */
    public function delete(string|int $key): void
    {
        $this->database->transaction(
            callback: fn() => $this->query->findOrFail(
                id: $key
            )->delete(),
            attempts: 3
        );
    }
}
