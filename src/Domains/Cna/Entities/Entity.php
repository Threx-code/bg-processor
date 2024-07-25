<?php

declare(strict_types=1);

namespace Domains\Cna\Entities;

use Domains\Cna\Models\Cna;
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
        public ?JsonObject $descriptions,
        public ?JsonObject $affected,
        public ?JsonObject $references,
        public ?JsonObject $xGenerator,
        public ?JsonObject $xLegacyV4Record,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(Cna $cna): Entity
    {
        return new self(
            cveId: $cna->cveId,
            title: $cna->title,
            providerMetaData: $cna->providerMetadata,
            problemTypes: $cna->problemTypes,
            descriptions: $cna->descriptions,
            affected: $cna->affected,
            references: $cna->references,
            xGenerator: $cna->xGenerator,
            xLegacyV4Record: $cna->xLegacyV4Record,
            key: $cna->key,
            id: $cna->id

        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_CVE_ID => $this->cveId,
            FieldInterface::FIELD_TITLE => $this->title,
            FieldInterface::FIELD_PROVIDER_METADATA => $this->providerMetaData->data,
            FieldInterface::FIELD_PROBLEM_TYPES => $this->problemTypes->data,
            FieldInterface::FIELD_DESCRIPTIONS => $this->descriptions->data,
            FieldInterface::FIELD_AFFECTED => $this->affected->data,
            FieldInterface::FIELD_REFERENCES => $this->references->data,
            FieldInterface::FIELD_X_GENERATOR => $this->xGenerator->data,
            FieldInterface::FIELD_X_LEGACY_V4_RECORD => $this->xLegacyV4Record->data,
        ];
    }
}
