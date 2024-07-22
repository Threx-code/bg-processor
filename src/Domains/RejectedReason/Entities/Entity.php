<?php

declare(strict_types=1);

namespace Domains\RejectedReason\Entities;

use Domains\Helpers\Payloads\FieldInterface;
use Domains\RejectedReason\Models\RejectedReason;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public int $cveId,
        public ?string $lang,
        public ?string $value,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(RejectedReason $reason): Entity
    {
        return new self(
            cveId: $reason->cveId,
            lang: $reason->lang,
            value: $reason->value,
            key: $reason->key,
            id: $reason->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_LANG => $this->lang,
            FieldInterface::FIELD_VALUE => $this->value,
            FieldInterface::FIELD_CVE_ID => $this->cveId
        ];
    }
}
