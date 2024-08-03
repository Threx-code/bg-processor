<?php

declare(strict_types=1);

namespace Domains\Cve\Entities;

use Domains\Cve\Models\Cve;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Helpers\ValueObjects\DateObject;
use Illuminate\Database\Eloquent\Collection;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public ?string $assignerOrgId = null,
        public ?string $title = null,
        public ?string $state = null,
        public ?string $dataType = null,
        public ?string $dataVersion = null,
        public ?string $assignerShortName = null,
        public ?DateObject $dateReserved = null,
        public ?DateObject $datePublished = null,
        public ?DateObject $dateUpdated = null,
        public ?string $key = null,
        public ?int $id = null,
        public ?Collection $adp = null,
        public ?Collection $cna = null
    ) {}

    public static function fromEloquent(Cve $cve): Entity
    {
        return new self(
            assignerOrgId: $cve->assignerOrgId,
            title: $cve->title,
            state: $cve->state,
            dataType: $cve->dataType,
            dataVersion: $cve->dataVersion,
            assignerShortName: $cve->assignerShortName,
            dateReserved: $cve->dateReserved,
            datePublished: $cve->datePublished,
            dateUpdated: $cve->dateUpdated,
            key: $cve->key,
            id: $cve->id,
            adp: $cve->adp,
            cna: $cve->cna
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::ASSIGNER_ORD_ID => $this->assignerOrgId,
            FieldInterface::FIELD_TITLE => $this->title,
            FieldInterface::FIELD_STATE => $this->state,
            FieldInterface::FIELD_DATA_TYPE => $this->dataType,
            FieldInterface::FIELD_DATA_VERSION => $this->dataVersion,
            FieldInterface::FIELD_ASSIGNER_SHORT_NAME => $this->assignerShortName,
            FieldInterface::FIELD_DATE_RESERVED => $this->dateReserved,
            FieldInterface::FIELD_DATE_PUBLISHED => $this->datePublished,
            FieldInterface::FIELD_DATE_UPDATED => $this->dateUpdated,
        ];
    }
}
