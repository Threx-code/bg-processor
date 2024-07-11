<?php

declare(strict_types=1);

namespace Domains\AffectedProduct\Entities;

use Domains\AffectedProduct\Models\AffectedProduct;
use Domains\Cve\Models\Cve;
use Domains\Helpers\Payloads\FieldInterface;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public Cve $cve,
        public ?string $product,
        public ?string $vendor,
        public ?string $defaultStatus,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(AffectedProduct $product): Entity
    {
        return new self(
            cve: $product->cveId,
            product: $product->product,
            vendor: $product->vendor,
            defaultStatus: $product->defaultStatus,
            key: $product->key,
            id: $product->id,
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_CVE_ID => $this->cve->id,
            FieldInterface::FIELD_PRODUCT => $this->product,
            FieldInterface::FIELD_VENDOR => $this->vendor,
            FieldInterface::FIELD_DEFAULT_STATUS => $this->defaultStatus,
        ];
    }
}
