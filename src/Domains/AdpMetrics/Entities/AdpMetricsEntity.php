<?php declare(strict_types=1);

namespace Domains\AdpMetrics\Entities;

use Domains\AdpMetrics\Models\AdpMetrics;
use Domains\Adp\ValueObjects\DateUpdatedObject;
use Infrastructures\Entities\DomainEntity;

final class AdpMetricsEntity extends DomainEntity
{
    public function __construct(
        public DateUpdatedObject $commit_date,
        public null|string       $key = null,
        public null|int          $id = null
    ){}

    public static function fromEloquent(AdpMetrics $metrics): AdpMetricsEntity
    {
        return new AdpMetricsEntity(
            commit_date: $metrics->commit_date,
            key: $metrics->key,
            id: $metrics->id

        );
    }

    public function toArray(): array
    {
        return [
            'commit_date' => $this->commit_date
        ];
    }
}
