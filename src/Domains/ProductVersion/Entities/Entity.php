<?php

declare(strict_types=1);

namespace Domains\ProductVersion\Entities;

use Domains\AffectedProduct\Models\AffectedProduct;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\ProductVersion\Models\ProductVersion;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public int $affectedProductId,
        public ?string $version,
        public ?string $lessThan,
        public ?string $status,
        public ?string $versionType,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(ProductVersion $version): Entity
    {
        return new self(
            affectedProductId: $version->affectedProductId,
            version: $version->version,
            lessThan: $version->lessThan,
            status: $version->status,
            versionType: $version->versionType,
            key: $version->key,
            id: $version->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_AFFECTED_PRODUCT_ID => $this->affectedProductId,
            FieldInterface::FIELD_VERSION => $this->version,
            FieldInterface::FIELD_LESS_THAN => $this->lessThan,
            FieldInterface::FIELD_STATUS => $this->status,
            FieldInterface::FIELD_VERSION_TYPE => $this->versionType
        ];
    }
}
