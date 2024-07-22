<?php

declare(strict_types=1);

namespace Domains\Cve\Entities;

use Domains\Cve\Models\Cve;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Helpers\ValueObjects\DateObject;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public ?string $title,
        public ?string $state,
        public ?string $assignerShortName,
        public DateObject $dateReserved,
        public DateObject $datePublished,
        public DateObject $dateUpdated,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(Cve $cve): Entity
    {
        return new self(
            title: $cve->title,
            state: $cve->state,
            assignerShortName: $cve->assignerShortName,
            dateReserved: $cve->dateReserved,
            datePublished: $cve->datePublished,
            dateUpdated: $cve->dateUpdated,
            key: $cve->key,
            id: $cve->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_TITLE => $this->title,
            FieldInterface::FIELD_STATE => $this->state,
            FieldInterface::FIELD_ASSIGNER_SHORT_NAME => $this->assignerShortName,
            FieldInterface::FIELD_DATE_RESERVED => $this->dateReserved,
            FieldInterface::FIELD_DATE_PUBLISHED => $this->datePublished,
            FieldInterface::FIELD_DATE_UPDATED => $this->dateUpdated,
        ];
    }
}
