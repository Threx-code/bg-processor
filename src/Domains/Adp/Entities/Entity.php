<?php

declare(strict_types=1);

namespace Domains\Adp\Entities;

use Domains\Adp\Models\Adp;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Helpers\ValueObjects\JsonObject;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public int $cveId,
        public ?string $title,
        public ?JsonObject $providerMetaData,
        public ?JsonObject $problemTypes,
        public ?JsonObject $affected,
        public ?JsonObject $metrics,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(Adp $adp): Entity
    {
        return new self(
            cveId: $adp->cveId,
            title: $adp->title,
            providerMetaData: $adp->providerMetaData,
            problemTypes: $adp->problemTypes,
            affected: $adp->affected,
            metrics: $adp->metrics,
            key: $adp->key,
            id: $adp->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_CVE_ID => $this->cveId,
            FieldInterface::FIELD_TITLE => $this->title,
            FieldInterface::FIELD_PROVIDER_METADATA => $this->providerMetaData->data,
            FieldInterface::FIELD_PROBLEM_TYPES => $this->problemTypes->data,
            FieldInterface::FIELD_AFFECTED => $this->affected->data,
            FieldInterface::FIELD_METRICS => $this->metrics->data,
        ];
    }
}
