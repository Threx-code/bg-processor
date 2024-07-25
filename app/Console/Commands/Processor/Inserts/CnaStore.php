<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor\Inserts;

use App\Helpers\Jsons\ProcessJson;
use Domains\Cna\Entities\Entity as CnaEntity;
use Domains\Cna\Models\Cna;
use Domains\Cna\Repositories\Repository as CnaRepository;
use Domains\Cna\Services\Service as CnaService;
use Domains\Helpers\Payloads\DefaultFieldInterface;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Helpers\ValueObjects\JsonObject;
use Illuminate\Database\Eloquent\Model;

class CnaStore extends BaseInsert
{
    public function process(): Model
    {
        $service = new CnaService(
            repository: new CnaRepository(
                query: Cna::query(),
                database: self::dbResolver()
            )
        );

        return $service->create(
            entity: new CnaEntity(
                cveId: $this->data[FieldInterface::FIELD_CVE_ID],
                title: $this->data[FieldInterface::FIELD_TITLE] ?? self::emptyString(),
                providerMetaData: self::jsonFormat(
                    data: $this->data[FieldInterface::FIELD_PROVIDER_METADATA]
                ),
                problemTypes: self::jsonFormat(
                    data: $this->data[FieldInterface::FIELD_PROBLEM_TYPES]
                ),
                descriptions: self::jsonFormat(
                    data: $this->data[FieldInterface::FIELD_DESCRIPTIONS]
                ),
                affected: self::jsonFormat(
                    data: $this->data[FieldInterface::FIELD_AFFECTED]
                ),
                references: self::jsonFormat(
                    data: $this->data[FieldInterface::FIELD_REFERENCES]
                ),
                xGenerator: self::jsonFormat(
                    data: $this->data[FieldInterface::FIELD_X_GENERATOR]
                ),
                xLegacyV4Record: self::jsonFormat(
                    data: $this->data[FieldInterface::FIELD_X_LEGACY_V4_RECORD]
                )
            )
        );
    }
}
