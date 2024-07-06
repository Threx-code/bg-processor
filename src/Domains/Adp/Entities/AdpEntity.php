<?php declare(strict_types=1);

namespace Domains\Adp\Entities;

use Domains\AdpMetrics\Models\Cve;
use Domains\Adp\Models\Adp;
use Domains\Adp\ValueObjects\DateUpdatedObject;
use Domains\Adp\ValueObjects\TitleObject;
use Infrastructures\Entities\DomainEntity;

final class AdpEntity extends DomainEntity
{
    public function __construct(
        public TitleObject $title,
        public DateUpdatedObject $dateUpdated,
        public Cve $cve,
        public null|string $shortName,
        public null|string $orgId,
        public null|string       $key = null,
        public null|int          $id = null
    ){}

    public static function fromEloquent(Adp $adp): AdpEntity
    {
        return new AdpEntity(
            title: $adp->title,
            dateUpdated: $adp->dateUpdated,
            cve: $adp->cve,
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


$table->timestamp('date_updated')->nullable();

