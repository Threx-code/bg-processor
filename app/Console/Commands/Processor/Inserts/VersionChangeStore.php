<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor\Inserts;

use Domains\Helpers\Payloads\FieldInterface;
use Domains\VersionChange\Entities\Entity as VersionChangeEntity;
use Domains\VersionChange\Models\VersionChange;
use Domains\VersionChange\Repositories\Repository as VersionChangeRepository;
use Domains\VersionChange\Services\Service as VersionChangeService;
use Illuminate\Database\Eloquent\Model;

class VersionChangeStore extends BaseInsert
{
    public function process(): Model
    {
        $service = new VersionChangeService(
            repository: new VersionChangeRepository(
                query: VersionChange::query(),
                database: self::dbResolver()
            )
        );

        return $service->create(
            entity: new VersionChangeEntity(
                productVersionId: $this->data[FieldInterface::FIELD_PRODUCT_VERSION_ID],
                at: $this->data[FieldInterface::FIELD_AT] ?? FieldInterface::FIELD_NULL,
                status: $this->data[FieldInterface::FIELD_STATUS] ?? FieldInterface::FIELD_NULL
            )
        );
    }
}
