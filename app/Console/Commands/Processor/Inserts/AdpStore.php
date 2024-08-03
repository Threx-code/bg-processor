<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor\Inserts;

use Domains\Adp\Entities\Entity as AdpEntity;
use Domains\Adp\Models\Adp;
use Domains\Adp\Repositories\Repository as AdpRepository;
use Domains\Adp\Services\Service as AdpService;
use Domains\Helpers\Payloads\FieldInterface;
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
                title: $this->data[FieldInterface::FIELD_TITLE] ?? self::emptyString(),
                providerMetaData: self::jsonFormat(
                    data: $this->data,
                    key: FieldInterface::FIELD_PROVIDER_METADATA
                ),
                problemTypes: self::jsonFormat(
                    data: $this->data,
                    key: FieldInterface::FIELD_PROBLEM_TYPES
                ),
                affected: self::jsonFormat(
                    data: $this->data,
                    key: FieldInterface::FIELD_AFFECTED
                ),
                metrics: self::jsonFormat(
                    data: $this->data,
                    key: FieldInterface::FIELD_METRICS
                ),
                dateUpdated: self::dateFormat(
                    date: $this->data,
                    key: FieldInterface::FIELD_DATE_UPDATED
                )
            )
        );
    }
}
