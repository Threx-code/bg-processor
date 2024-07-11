<?php

declare(strict_types=1);

namespace Domains\SolutionSupportingMedia\Entities;

use Domains\Helpers\Payloads\FieldInterface;
use Domains\Solution\Models\Solution;
use Domains\SolutionSupportingMedia\Models\SolutionSupportingMedia;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public Solution $solution,
        public ?bool $base64,
        public ?string $type,
        public ?string $value,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(SolutionSupportingMedia $supportingMedia): Entity
    {
        return new self(
            solution: $supportingMedia->solutionId,
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
            FieldInterface::FIELD_SOLUTION_ID => $this->solution->id,
            FieldInterface::FIELD_BASE64 => $this->base64,
            FieldInterface::FIELD_TYPE => $this->type,
            FieldInterface::FIELD_VALUE => $this->value,
        ];
    }
}
