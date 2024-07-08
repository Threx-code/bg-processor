<?php declare(strict_types=1);

namespace Domains\Cve\Services;

use Domains\Adp\Entities\CveEntity;
use Domains\Adp\Models\Adp;
use Domains\Adp\Repositories\CveRepository;
use Illuminate\Support\Collection;
use Throwable;

final readonly class CveService
{
    public function __construct(
        private CveRepository $repository
    ){}

    public function all(): Collection
    {
        return $this->repository->all()->map(
            callback: fn(Adp $adp): CveEntity => CveEntity::fromEloquent(
                adp: $adp
            )
        );
    }

    /**
     * @param CveEntity $commit
     * @return void
     * @throws Throwable
     */
    public function create(CveEntity $commit): void
    {
        $this->repository->create(entity: $commit);
    }

    /**
     * @param string $key
     * @param CveEntity $commit
     * @return void
     * @throws Throwable
     */
    public function update(string $key, CveEntity $commit): void
    {
        $this->repository->update(key: $key, entity: $commit);
    }
}
