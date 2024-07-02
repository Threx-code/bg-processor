<?php declare(strict_types=1);

namespace Infrastructures\Repositories;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Infrastructures\Entities\DomainEntity;

/**
 * @property-read DatabaseManager $databaseManager
 * @property-read Builder $query
 */
interface RepositoryInterface
{
    public function all(): Collection;
    public function find(int|string $key, array $with = []): null|object;
    public function create(DomainEntity $entity): void;
    public function update(int|string $key, DomainEntity $entity): void;
    public function delete(int|string $key): void;
}
