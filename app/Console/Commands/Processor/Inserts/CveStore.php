<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor\Inserts;

use Domains\Cve\Entities\Entity as CveEntity;
use Domains\Cve\Models\Cve;
use Domains\Cve\Repositories\Repository;
use Domains\Cve\Services\Service as CveService;
use Domains\Helpers\Payloads\FieldInterface;
use Illuminate\Database\Eloquent\Model;

class CveStore extends BaseInsert
{
    public function __construct(
        array $data,
        private readonly ?string $key = null
    ) {
        parent::__construct($data);
    }

    public function process(): Model
    {
        $service = new CveService(
            repository: new Repository(
                query: Cve::query(),
                database: self::dbResolver()
            )
        );

        return empty($this->key) ? $this->create($service) : $this->update($service);
    }

    public function create(CveService $service): Model
    {
        return $service->create(
            entity: new CveEntity(
                assignerOrgId: $this->data[FieldInterface::ASSIGNER_ORD_ID],
                title: $this->data[FieldInterface::FIELD_CVE_ID],
                state: $this->data[FieldInterface::FIELD_STATE] ?? self::emptyString(),
                dataType: $this->data[FieldInterface::FIELD_DATA_TYPE] ?? self::emptyString(),
                dataVersion: $this->data[FieldInterface::FIELD_DATA_VERSION] ?? self::emptyString(),
                assignerShortName: $this->data[FieldInterface::FIELD_ASSIGNER_SHORT_NAME] ?? self::emptyString(),
                dateReserved: self::dateFormat(
                    date: $this->data,
                    key: FieldInterface::FIELD_DATE_RESERVED
                ),
                datePublished: self::dateFormat(
                    date: $this->data,
                    key: FieldInterface::FIELD_DATE_PUBLISHED
                ),
                dateUpdated: self::dateFormat(
                    date: $this->data,
                    key: FieldInterface::FIELD_DATE_UPDATED
                )
            )
        );
    }

    private function update(CveService $service): Model
    {
        return $service->update(
            key: $this->key,
            entity: new CveEntity(
                dateReserved: self::dateFormat(
                    date: $this->data,
                    key: FieldInterface::FIELD_DATE_RESERVED
                ),
            )
        );
    }
}
