<?php

declare(strict_types=1);

namespace Domains\Reference\Entities;

use Domains\Cve\Models\Cve;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Reference\Models\Reference;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public Cve $cve,
        public ?string $url,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(Reference $reference): Entity
    {
        return new self(
            cve: $reference->cveId,
            url: $reference->url,
            key: $reference->key,
            id: $reference->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_CVE_ID => $this->cve->id,
            FieldInterface::FIELD_URL => $this->url,
        ];
    }
}
