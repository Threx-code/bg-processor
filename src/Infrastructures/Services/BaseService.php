<?php

declare(strict_types=1);

namespace Infrastructures\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Repositories\Repository;
use Throwable;

abstract class BaseService
{
    public function __construct(
        private readonly Repository $repository
    ) {}

    /**
     * @param Model $model
     * @return DomainEntity
     */
    abstract protected function mapToEntity(Model $model): DomainEntity;

    /**
     * @return Collection
     */
    public function all(): Collection
    {
        return $this->repository->all()->map(
            callback: fn (Model $entity): DomainEntity => $this->mapToEntity($entity)
        );
    }

    /**
     * @param DomainEntity $entity
     * @return void
     * @throws Throwable
     */
    public function create(DomainEntity $entity): void
    {
        $this->repository->create(entity: $entity);
    }

    /**
     * @throws Throwable
     */
    public function update(string $key, DomainEntity $entity): void
    {
        $this->repository->update(key: $key, entity: $entity);
    }
}
