<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor\Inserts;

use Domains\Helpers\Payloads\FieldInterface;
use Domains\RejectedReason\Entities\Entity as RejectedReasonEntity;
use Domains\RejectedReason\Models\RejectedReason;
use Domains\RejectedReason\Repositories\Repository as RejectedReasonRepository;
use Domains\RejectedReason\Services\Service as RejectedReasonService;
use Illuminate\Database\Eloquent\Model;

class RejectedReasonStore extends BaseInsert
{
    public function process(): Model
    {
        $service = new RejectedReasonService(
            repository: new RejectedReasonRepository(
                query: RejectedReason::query(),
                database: self::dbResolver()
            )
        );

        return $service->create(
            entity: new RejectedReasonEntity(
                cveId: $this->data[FieldInterface::FIELD_CVE_ID],
                lang: $this->data[FieldInterface::FIELD_LANG],
                value: $this->data[FieldInterface::FIELD_VALUE]
            )
        );

    }
}
