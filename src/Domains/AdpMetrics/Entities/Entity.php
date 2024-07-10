<?php

declare(strict_types=1);

namespace Domains\AdpMetrics\Entities;

use Domains\Adp\Models\Adp;
use Domains\AdpMetrics\Models\AdpMetric;
use Domains\Helpers\ValueObjects\DateObject;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public Adp $adp,
        public ?string $type,
        public ?string $contentId,
        public ?string $role,
        public ?string $exploitation,
        public ?string $automatable,
        public ?string $technicalImpact,
        public ?string $version,
        public ?DateObject $date,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(AdpMetric $adpMetric): Entity
    {
        return new self(
            adp: $adpMetric->adp,
            type: $adpMetric->type,
            contentId: $adpMetric->contentId,
            role: $adpMetric->role,
            exploitation: $adpMetric->exploitation,
            automatable: $adpMetric->automatable,
            technicalImpact: $adpMetric->technicalImpact,
            version: $adpMetric->version,
            date: $adpMetric->date,
            key: $adpMetric->key,
            id: $adpMetric->id
        );
    }

    public function toArray(): array
    {
        return [
            'adpId' => $this->adp->id,
            'type' => $this->type,
            'contentId' => $this->contentId,
            'role' => $this->role,
            'exploitation' => $this->exploitation,
            'automatable' => $this->automatable,
            'technicalImpact' => $this->technicalImpact,
            'version' => $this->version,
            'date' => $this->date,
        ];
    }
}
