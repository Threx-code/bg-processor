<?php

declare(strict_types=1);

namespace Domains\Adp\Entities;

use Domains\Adp\Models\Adp;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Helpers\ValueObjects\DateObject;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public int $cveId,
        public ?DateObject $dateUpdated,
        public ?string $title,
        public ?string $shortName,
        public ?string $orgId,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(Adp $adp): Entity
    {
        return new self(
            cveId: $adp->cveId,
            dateUpdated: $adp->dateUpdated,
            title: $adp->title,
            shortName: $adp->shortName,
            orgId: $adp->orgId,
            key: $adp->key,
            id: $adp->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_TITLE => $this->title,
            FieldInterface::FIELD_DATE_UPDATED => $this->dateUpdated,
            FieldInterface::FIELD_CVE_ID => $this->cveId,
            FieldInterface::FIELD_SHORT_NAME => $this->shortName,
            FieldInterface::FIELD_ORG_ID => $this->orgId,
        ];
    }
}
