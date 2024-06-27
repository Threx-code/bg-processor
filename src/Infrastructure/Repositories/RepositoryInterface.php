<?php declare(strict_types=1);

namespace Infrastructure\Repositories;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;


/**
 * @property-read DatabaseManager $databaseManager
 * @property-read Builder $query
 */
interface RepositoryInterface
{
    public function all(): Collection;
    public function find(int|string $key, array $with = []): null|object;

    public function create(object $entity): void;
    public function update(int|string $key, object $entity): void;
    public function delete(int|string $key): void;
}
