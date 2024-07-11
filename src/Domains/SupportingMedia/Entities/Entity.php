<?php

declare(strict_types=1);

namespace Domains\SupportingMedia\Entities;

use Domains\Description\Models\Description;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\SupportingMedia\Models\SupportingMedia;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public Description $description,
        public ?bool $base64,
        public ?string $type,
        public ?string $value,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(SupportingMedia $supportingMedia): Entity
    {
        return new self(
            description: $supportingMedia->descriptionId,
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
            FieldInterface::FIELD_DESCRIPTION_ID => $this->description->id,
            FieldInterface::FIELD_BASE64 => $this->base64,
            FieldInterface::FIELD_TYPE => $this->type,
            FieldInterface::FIELD_VALUE => $this->value,
        ];
    }
}
