<?php

declare(strict_types=1);

namespace Domains\ProblemType\Entities;

use Domains\Cve\Models\Cve;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\ProblemType\Models\ProblemType;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public int $cveId,
        public ?string $cweId,
        public ?string $description,
        public ?string $lang,
        public ?string $type,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(ProblemType $type): Entity
    {
        return new self(
            cveId: $type->cveId,
            cweId: $type->cweId,
            description: $type->description,
            lang: $type->lang,
            type: $type->type,
            key: $type->key,
            id: $type->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_CVE_ID => $this->cveId,
            FieldInterface::FIELD_CWE_ID => $this->cweId,
            FieldInterface::FIELD_DESCRIPTION => $this->description,
            FieldInterface::FIELD_LANG => $this->lang,
            FieldInterface::FIELD_TYPE => $this->type,
        ];
    }
}
