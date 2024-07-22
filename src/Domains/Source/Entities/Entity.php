<?php

declare(strict_types=1);

namespace Domains\Source\Entities;

use Domains\Cve\Models\Cve;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Source\Models\Source;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public int $cveId,
        public ?string $defect,
        public ?string $discovery,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(Source $source): Entity
    {
        return new self(
            cveId: $source->cveId,
            defect: $source->defect,
            discovery: $source->discovery,
            key: $source->key,
            id: $source->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_CVE_ID => $this->cveId,
            FieldInterface::FIELD_DEFECT => $this->defect,
            FieldInterface::FIELD_DISCOVERY => $this->discovery,
        ];
    }
}
