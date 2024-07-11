<?php

declare(strict_types=1);

namespace Domains\Timeline\Entities;

use Domains\Cve\Models\Cve;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Timeline\Models\Timeline;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public Cve $cve,
        public ?string $lang,
        public ?string $time,
        public ?string $value,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(Timeline $timeline): Entity
    {
        return new self(
            cve: $timeline->cveId,
            lang: $timeline->lang,
            time: $timeline->time,
            value: $timeline->value,
            key: $timeline->key,
            id: $timeline->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_CVE_ID => $this->cve->id,
            FieldInterface::FIELD_LANG => $this->lang,
            FieldInterface::FIELD_TIME => $this->time,
            FieldInterface::FIELD_VALUE => $this->value,
        ];
    }
}
