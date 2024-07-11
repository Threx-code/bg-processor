<?php

declare(strict_types=1);

namespace Domains\VersionChange\Entities;

use Domains\AffectedProduct\Models\AffectedProduct;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\VersionChange\Models\VersionChange;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public AffectedProduct $affectedProduct,
        public ?string $at,
        public ?string $status,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(VersionChange $change): Entity
    {
        return new self(
            affectedProduct: $change->affectedProductId,
            at: $change->at,
            status: $change->status,
            key: $change->key,
            id: $change->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_AFFECTED_PRODUCT_ID => $this->affectedProduct->id,
            FieldInterface::FIELD_AT => $this->at,
            FieldInterface::FIELD_STATUS => $this->status,
        ];
    }
}
