<?php

declare(strict_types=1);

namespace Domains\AdpMetrics\Entities;

use Domains\Adp\Models\Adp;
use Domains\AdpMetrics\Models\AdpMetric;
use Domains\Helpers\Payloads\FieldInterface;
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
            adp: $adpMetric->adpId,
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
            FieldInterface::FIELD_ADP_ID => $this->adp->id,
            FieldInterface::FIELD_TYPE => $this->type,
            FieldInterface::FIELD_CONTENT_ID => $this->contentId,
            FieldInterface::FIELD_ROLE => $this->role,
            FieldInterface::FIELD_EXPLOITATION => $this->exploitation,
            FieldInterface::FIELD_AUTOMATABLE => $this->automatable,
            FieldInterface::FIELD_TECHNICAL_IMPACT => $this->technicalImpact,
            FieldInterface::FIELD_VERSION => $this->version,
            FieldInterface::FIELD_DATE => $this->date,
        ];
    }
}
