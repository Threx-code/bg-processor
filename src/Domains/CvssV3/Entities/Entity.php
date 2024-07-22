<?php

declare(strict_types=1);

namespace Domains\CvssV3\Entities;

use Domains\CvssV3\Models\CvssV3;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Metric\Models\Metric;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public int $metricId,
        public ?string $attackComplexity,
        public ?string $attackVector,
        public ?string $availabilityImpact,
        public ?float $baseScore,
        public ?string $baseSeverity,
        public ?string $confidentialityImpact,
        public ?string $integrityImpact,
        public ?string $privilegesRequired,
        public ?string $scope,
        public ?string $userInteraction,
        public ?string $vectorString,
        public ?string $version,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(CvssV3 $cvssV3): Entity
    {
        return new self(
            metricId: $cvssV3->metricId,
            attackComplexity: $cvssV3->attackComplexity,
            attackVector: $cvssV3->attackVector,
            availabilityImpact: $cvssV3->availabilityImpact,
            baseScore: $cvssV3->baseScore,
            baseSeverity: $cvssV3->baseSeverity,
            confidentialityImpact: $cvssV3->confidentialityImpact,
            integrityImpact: $cvssV3->integrityImpact,
            privilegesRequired: $cvssV3->privilegesRequired,
            scope: $cvssV3->scope,
            userInteraction: $cvssV3->userInteraction,
            vectorString: $cvssV3->vectorString,
            version: $cvssV3->version,
            key: $cvssV3->key,
            id: $cvssV3->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_METRIC_ID => $this->metricId,
            FieldInterface::FIELD_ATTACK_COMPLEXITY => $this->attackComplexity,
            FieldInterface::FIELD_ATTACK_VECTOR => $this->attackVector,
            FieldInterface::FIELD_AVAILABILITY_IMPACT => $this->availabilityImpact,
            FieldInterface::FIELD_BASE_SCORE => $this->baseScore,
            FieldInterface::FIELD_BASE_SEVERITY => $this->baseSeverity,
            FieldInterface::FIELD_CONFIDENTIALITY_IMPACT => $this->confidentialityImpact,
            FieldInterface::FIELD_INTEGRITY_IMPACT => $this->integrityImpact,
            FieldInterface::FIELD_PRIVILEGES_REQUIRED => $this->privilegesRequired,
            FieldInterface::FIELD_SCOPE => $this->scope,
            FieldInterface::FIELD_USER_INTERACTION => $this->userInteraction,
            FieldInterface::FIELD_VECTOR_STRING => $this->vectorString,
            FieldInterface::FIELD_VERSION => $this->version,
        ];
    }
}
