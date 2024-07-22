<?php

declare(strict_types=1);

namespace Domains\Metric\Entities;

use Domains\Cve\Models\Cve;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Metric\Models\Metric;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public int $cveId,
        public ?string $format,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(Metric $metric): Entity
    {
        return new self(
            cveId: $metric->cveId,
            format: $metric->format,
            key: $metric->key,
            id: $metric->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_CVE_ID => $this->cveId,
            FieldInterface::FIELD_FORMAT => $this->format
        ];
    }
}
