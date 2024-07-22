<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor\Inserts;

use Domains\AffectedProduct\Entities\Entity as AffectedProductEntity;
use Domains\AffectedProduct\Models\AffectedProduct;
use Domains\AffectedProduct\Repositories\Repository as AffectedProductRepository;
use Domains\AffectedProduct\Services\Service as AffectedProductService;
use Domains\Helpers\Payloads\FieldInterface;
use Illuminate\Database\Eloquent\Model;

class AffectedProductsStore extends BaseInsert
{
    public function process(): Model
    {
        return (
            new AffectedProductService(
                repository: new AffectedProductRepository(
                    query: AffectedProduct::query(),
                    database: self::dbResolver()
                )
            )
        )->create(
            entity: new AffectedProductEntity(
                cveId: $this->data[FieldInterface::FIELD_CVE_ID],
                product: $this->data[FieldInterface::FIELD_PRODUCT] ?? FieldInterface::FIELD_NULL,
                vendor: $this->data[FieldInterface::FIELD_VENDOR] ?? FieldInterface::FIELD_NULL,
                defaultStatus: $this->data[FieldInterface::FIELD_DEFAULT_STATUS] ?? FieldInterface::FIELD_NULL
            )
        );
    }
}
