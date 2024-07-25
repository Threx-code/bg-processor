<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor\Inserts;

use App\Helpers\Jsons\ProcessJson;
use Domains\Cna\Entities\Entity as CnaEntity;
use Domains\Cna\Models\Cna;
use Domains\Cna\Repositories\Repository as CnaRepository;
use Domains\Cna\Services\Service as CnaService;
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
                title: $this->data[FieldInterface::FIELD_TITLE] ?? FieldInterface::FIELD_NULL,
                providerMetaData: new JsonObject(
                    ProcessJson::format(
                        data: $this->data[FieldInterface::FIELD_PROVIDER_METADATA] ?? FieldInterface::FIELD_EMPTY_ARRAY
                    )
                ),
                problemTypes: new JsonObject(
                    ProcessJson::format(
                        data: $this->data[FieldInterface::FIELD_PROBLEM_TYPES] ?? FieldInterface::FIELD_EMPTY_ARRAY
                    )
                ),
                descriptions: new JsonObject(
                    ProcessJson::format(
                        data: $this->data[FieldInterface::FIELD_DESCRIPTIONS] ?? FieldInterface::FIELD_EMPTY_ARRAY
                    )
                ),
                affected: new JsonObject(
                    ProcessJson::format(
                        data: $this->data[FieldInterface::FIELD_AFFECTED] ?? FieldInterface::FIELD_EMPTY_ARRAY
                    )
                ),
                references: new JsonObject(
                    ProcessJson::format(
                        data: $this->data[FieldInterface::FIELD_REFERENCES] ?? FieldInterface::FIELD_EMPTY_ARRAY
                    )
                ),
                xGenerator: new JsonObject(
                    ProcessJson::format(
                        data: $this->data[FieldInterface::FIELD_X_GENERATOR] ?? FieldInterface::FIELD_EMPTY_ARRAY
                    )
                ),
                xLegacyV4Record: new JsonObject(
                    ProcessJson::format(
                        data: $this->data[FieldInterface::FIELD_X_LEGACY_V4_RECORD] ?? FieldInterface::FIELD_EMPTY_ARRAY
                    )
                )
            )
        );
    }
}
