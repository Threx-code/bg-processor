<?php

declare(strict_types=1);

namespace Domains\Scenario\Entities;


use Domains\Helpers\Payloads\FieldInterface;
use Domains\Metric\Models\Metric;
use Domains\Scenario\Models\Scenario;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public Metric $metric,
        public ?string $lang,
        public ?string $value,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(Scenario $scenario): Entity
    {
        return new self(
            metric: $scenario->metricId,
            lang: $scenario->lang,
            value: $scenario->value,
            key: $scenario->key,
            id: $scenario->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_METRIC_ID => $this->metric->id,
            FieldInterface::FIELD_LANG => $this->lang,
            FieldInterface::FIELD_VALUE => $this->value,
        ];
    }
}
