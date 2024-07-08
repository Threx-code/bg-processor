<?php

declare(strict_types=1);

namespace Domains\Cve\Entities;

use Domains\Cve\Models\Cve;
use Domains\Helpers\ValueObjects\DateObject;
use Infrastructures\Entities\DomainEntity;

final class CveEntity extends DomainEntity
{
    public function __construct(
        public ?string $cveId,
        public ?string $title,
        public ?string $state,
        public ?string $assignerShortName,
        public DateObject $dateReserved,
        public DateObject $datePublished,
        public DateObject $dateUpdated,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(Cve $cve): CveEntity
    {
        return new self(
            cveId: $cve->cveId,
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
            'cveId' => $this->cveId,
            'title' => $this->title,
            'state' => $this->state,
            'assignerShortName' => $this->assignerShortName,
            'dateReserved' => $this->dateReserved,
            'datePublished' => $this->datePublished,
            'dateUpdated' => $this->dateUpdated,
        ];
    }
}
