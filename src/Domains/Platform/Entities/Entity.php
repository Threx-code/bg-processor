<?php

declare(strict_types=1);

namespace Domains\Platform\Entities;

use Domains\AffectedProduct\Models\AffectedProduct;
use Domains\CveFileNames\Models\CveFileNames;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Platform\Models\Platform;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public int $affectedProductId,
        public ?string $platform,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(Platform $platform): Entity
    {
        return new self(
            affectedProductId: $platform->affectedProductId,
            platform: $platform->platform,
            key: $platform->key,
            id: $platform->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_AFFECTED_PRODUCT_ID => $this->affectedProductId,
            FieldInterface::FIELD_PLATFORM => $this->platform,
        ];
    }
}
