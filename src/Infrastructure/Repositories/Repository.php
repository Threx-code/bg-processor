<?php declare(strict_types=1);

namespace Infrastructure\Repositories;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Throwable;

abstract class Repository implements RepositoryInterface
{
    public function __construct(
        private readonly Builder $query,
        private readonly DatabaseManager $database
    ){}

    public function all(): Collection
    {
        return $this->query->get();
    }

    public function find(string|int $key, array $with = []): null|object
    {
        return $this->query->with(
            relations: $with
        )->findOrFail(
            id: $key
        );
    }

    /**
     * @throws Throwable
     */
    public function create(object $entity): void
    {
        $this->database->transaction(
            callback: fn () => $this->query->create(
                attributes: $entity->toArray()
            ),
            attempts: 3
        );
    }

    /**
     * @throws Throwable
     */
    public function update(string|int $key, object $entity): void
    {
        $this->database->transaction(
            callback: fn () => $this->query->findOrFail(
                id: $key
            )->update(
                attributes: $entity->toArray()
            ),
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
{

}
