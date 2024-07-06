<?php declare(strict_types=1);

namespace Domains\GitHub\Services;

use Domains\GitHub\Models\GithubCommit;
use Domains\AdpMetrics\Entities\AdpMetricsEntity;
use Domains\Adp\Repositories\AdpRepository;
use Illuminate\Support\Collection;
use Throwable;

final readonly class AdpMetricsService
{
    public function __construct(
        private AdpRepository $repository
    ){}

    public function all(): Collection
    {
        return $this->repository->all()->map(
            callback: fn(GithubCommit $commit): AdpMetricsEntity => AdpMetricsEntity::fromEloquent(
                commit: $commit
            )
        );
    }

    /**
     * @param AdpMetricsEntity $commit
     * @return void
     * @throws Throwable
     */
    public function create(AdpMetricsEntity $commit): void
    {
        $this->repository->create(entity: $commit);
    }

    /**
     * @param string $key
     * @param AdpMetricsEntity $commit
     * @return void
     * @throws Throwable
     */
    public function update(string $key, AdpMetricsEntity $commit): void
    {
        $this->repository->update(key: $key, entity: $commit);
    }
}
