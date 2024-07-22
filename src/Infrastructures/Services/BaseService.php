<?php

declare(strict_types=1);

namespace Infrastructures\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Repositories\Repository;
use Infrastructures\Repositories\RepositoryInterface;
use Throwable;

abstract class BaseService
{
    public function __construct(
        private readonly RepositoryInterface $repository
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
     * @return Model
     */
    public function create(DomainEntity $entity): Model
    {
        return $this->repository->create(entity: $entity);
    }

    /**
     * @param string $key
     * @param DomainEntity $entity
     * @return Model
     */
    public function update(string $key, DomainEntity $entity): Model
    {
        return $this->repository->update(key: $key, entity: $entity);
    }
}
