<?php

declare(strict_types=1);

namespace Domains\ProblemDescription\Entities;

use Domains\Helpers\Payloads\FieldInterface;
use Domains\ProblemDescription\Models\ProblemDescription;
use Domains\ProblemType\Models\ProblemType;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public int $problemTypeId,
        public ?string $cweId,
        public ?string $lang,
        public ?string $type,
        public ?string $description,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(ProblemDescription $description): Entity
    {
        return new self(
            problemTypeId: $description->problemTypeId,
            cweId: $description->cweId,
            lang: $description->lang,
            type: $description->type,
            description: $description->description,
            key: $description->key,
            id: $description->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_PROBLEM_TYPE_ID => $this->problemTypeId,
            FieldInterface::FIELD_CWE_ID => $this->cweId,
            FieldInterface::FIELD_LANG => $this->lang,
            FieldInterface::FIELD_TYPE => $this->type,
            FieldInterface::FIELD_DESCRIPTION => $this->description,
        ];
    }
}
