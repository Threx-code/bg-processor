<?php

declare(strict_types=1);

namespace Domains\Adp\Entities;

use Domains\Adp\Models\Adp;
use Domains\Cve\Models\Cve;
use Domains\Helpers\ValueObjects\DateObject;
use Infrastructures\Entities\DomainEntity;

final class AdpEntity extends DomainEntity
{
    public function __construct(
        public DateObject $dateUpdated,
        public Cve $cve,
        public ?string $title,
        public ?string $shortName,
        public ?string $orgId,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(Adp $adp): AdpEntity
    {
        return new AdpEntity(
            dateUpdated: $adp->dateUpdated,
            cve: $adp->cve,
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
            'title' => $this->title,
            'dateUpdated' => $this->dateUpdated,
            'cveId' => $this->cve->id,
            'shortName' => $this->shortName,
            'orgId' => $this->orgId,
        ];
    }
}
