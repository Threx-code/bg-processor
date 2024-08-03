<?php

declare(strict_types=1);

namespace Infrastructures\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Repositories\RepositoryInterface;

abstract class BaseService
{
    public function __construct(
        private readonly RepositoryInterface $repository
    ) {}

    abstract protected function mapToEntity(Model $model): DomainEntity;

    public function all(): Collection
    {
        return $this->repository->all()->map(
            callback: fn (Model $entity): DomainEntity => $this->mapToEntity($entity)
        );
    }

    public function findBy(string $column, string $value, $with = []): Collection
    {
        return $this->repository->findBy(column: $column, value: $value, with: $with)->map(
            callback: fn (Model $entity): DomainEntity => $this->mapToEntity($entity)
        );
    }

    public function create(DomainEntity $entity): Model
    {
        return $this->repository->create(entity: $entity);
    }

    public function update(string $key, DomainEntity $entity): Model
    {
        return $this->repository->update(key: $key, entity: $entity);
    }
}
