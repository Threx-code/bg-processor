<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor\Inserts;

use App\Helpers\Dates\DateImmutable;
use Domains\Cve\Entities\Entity as CveEntity;
use Domains\Cve\Models\Cve;
use Domains\Cve\Repositories\Repository;
use Domains\Cve\Services\Service as CveService;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Helpers\ValueObjects\DateObject;
use Illuminate\Database\Eloquent\Model;

class CveStore extends BaseInsert
{
    public function process(): Model
    {
        return (
            new CveService(
                repository: new Repository(
                    query: Cve::query(),
                    database: self::dbResolver()
                )
            )
        )->create(
            entity: new CveEntity(
                assignerOrgId: $this->data[FieldInterface::ASSIGNER_ORD_ID],
                title: $this->data[FieldInterface::FIELD_CVE_ID],
                state: $this->data[FieldInterface::FIELD_STATE],
                assignerShortName: $this->data[FieldInterface::FIELD_ASSIGNER_SHORT_NAME],
                dateReserved: new DateObject(
                    date: DateImmutable::format(
                        date: $this->data[FieldInterface::FIELD_DATE_RESERVED]
                    )
                ),
                datePublished: new DateObject(
                    date: DateImmutable::format(
                        date: $this->data[FieldInterface::FIELD_DATE_PUBLISHED]
                    )
                ),
                dateUpdated: new DateObject(
                    date: DateImmutable::format(
                        date: $this->data[FieldInterface::FIELD_DATE_UPDATED]
                    )
                )
            )
        );
    }
}
