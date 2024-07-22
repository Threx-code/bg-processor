<?php

declare(strict_types=1);

namespace Domains\VersionChange\Entities;

use Domains\AffectedProduct\Models\AffectedProduct;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\ProductVersion\Models\ProductVersion;
use Domains\VersionChange\Models\VersionChange;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public ProductVersion $productVersion,
        public ?string $at,
        public ?string $status,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(VersionChange $change): Entity
    {
        return new self(
            productVersion: $change->productVersionId,
            at: $change->at,
            status: $change->status,
            key: $change->key,
            id: $change->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_PRODUCT_VERSION_ID => $this->productVersion->id,
            FieldInterface::FIELD_AT => $this->at,
            FieldInterface::FIELD_STATUS => $this->status,
        ];
    }
}
