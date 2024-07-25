<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor\Inserts;

use App\Helpers\Jsons\ProcessJson;
use Domains\Adp\Entities\Entity as AdpEntity;
use Domains\Adp\Models\Adp;
use Domains\Adp\Repositories\Repository as AdpRepository;
use Domains\Adp\Services\Service as AdpService;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Helpers\ValueObjects\JsonObject;
use Illuminate\Database\Eloquent\Model;

class AdpStore extends BaseInsert
{
    public function process(): Model
    {
        $service = new AdpService(
            repository: new AdpRepository(
                query: Adp::query(),
                database: self::dbResolver()
            )
        );

        return $service->create(
            entity: new AdpEntity(
                cveId: $this->data[FieldInterface::FIELD_CVE_ID],
                title: $this->data[FieldInterface::FIELD_TITLE],
                providerMetaData: new JsonObject(
                    ProcessJson::format(
                        data: $this->data[FieldInterface::FIELD_PROVIDER_META_DATA] ?? FieldInterface::FIELD_EMPTY_ARRAY
                    )
                ),
                problemTypes: new JsonObject(
                    ProcessJson::format(
                        data: $this->data[FieldInterface::FIELD_PROBLEM_TYPES] ?? FieldInterface::FIELD_EMPTY_ARRAY
                    )
                ),
                affected: new JsonObject(
                    ProcessJson::format(
                        data: $this->data[FieldInterface::FIELD_AFFECTED] ?? FieldInterface::FIELD_EMPTY_ARRAY
                    )
                ),
                metrics: new JsonObject(
                    ProcessJson::format(
                        data: $this->data[FieldInterface::FIELD_METRICS] ?? FieldInterface::FIELD_EMPTY_ARRAY
                    )
                )
            )
        );
    }
}
