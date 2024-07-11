<?php

declare(strict_types=1);

namespace Domains\Description\Entities;

use Domains\Cve\Models\Cve;
use Domains\Description\Models\Description;
use Domains\Helpers\Payloads\FieldInterface;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public Cve $cveId,
        public string $value,
        public ?string $key = null,
        public ?int $id = null
    ) {}


    public static function fromEloquent(Description $description): Entity
    {
        return new self(
            cveId: $description->cveId,
            value: $description->value,
            key: $description->key,
            id: $description->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_CVE_ID => $this->cveId->id,
            FieldInterface::FIELD_VALUE => $this->value,
        ];
    }
}
