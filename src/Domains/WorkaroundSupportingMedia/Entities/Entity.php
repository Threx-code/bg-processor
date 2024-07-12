<?php

declare(strict_types=1);

namespace Domains\WorkaroundSupportingMedia\Entities;

use Domains\CveFileNames\Models\CveFileNames;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Workaround\Models\Workaround;
use Domains\WorkaroundSupportingMedia\Models\WorkaroundSupportingMedia;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public Workaround $workaround,
        public ?bool $base64,
        public ?string $type,
        public ?string $value,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(WorkaroundSupportingMedia $supportingMedia): Entity
    {
        return new self(
            workaround: $supportingMedia->workaroundId,
            base64: $supportingMedia->base64,
            type: $supportingMedia->type,
            value: $supportingMedia->value,
            key: $supportingMedia->key,
            id: $supportingMedia->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_WORKAROUND_ID => $this->workaround->id,
            FieldInterface::FIELD_BASE64 => $this->base64,
            FieldInterface::FIELD_TYPE => $this->type,
            FieldInterface::FIELD_VALUE => $this->value,
        ];
    }
}
