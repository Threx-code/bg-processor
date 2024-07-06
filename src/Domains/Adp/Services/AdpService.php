<?php declare(strict_types=1);

namespace Domains\Adp\Services;

use Domains\Adp\Entities\AdpEntity;
use Domains\Adp\Models\Adp;
use Domains\Adp\Repositories\AdpRepository;
use Illuminate\Support\Collection;
use Throwable;

final readonly class AdpService
{
    public function __construct(
        private AdpRepository $repository
    ){}

    public function all(): Collection
    {
        return $this->repository->all()->map(
            callback: fn(Adp $adp): AdpEntity => AdpEntity::fromEloquent(
                adp: $adp
            )
        );
    }

    /**
     * @param AdpEntity $commit
     * @return void
     * @throws Throwable
     */
    public function create(AdpEntity $commit): void
    {
        $this->repository->create(entity: $commit);
    }

    /**
     * @param string $key
     * @param AdpEntity $commit
     * @return void
     * @throws Throwable
     */
    public function update(string $key, AdpEntity $commit): void
    {
        $this->repository->update(key: $key, entity: $commit);
    }
}
