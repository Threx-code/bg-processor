<?php declare(strict_types=1);

namespace App\Console\Commands\Processor\Inserts;

use Domains\Helpers\Payloads\FieldInterface;
use Illuminate\Database\Eloquent\Model;
use Domains\ProductVersion\Models\ProductVersion;
use Domains\ProductVersion\Services\Service as ProductVersionService;
use Domains\ProductVersion\Repositories\Repository as ProductVersionRepository;
use Domains\ProductVersion\Entities\Entity as ProductVersionEntity;

class ProductVersionStore extends BaseInsert
{

    public function process(): Model
    {
        $service = new ProductVersionService(
            repository: new ProductVersionRepository(
                query: ProductVersion::query(),
                database: self::dbResolver()
            )
        );

        return $service->create(
            entity: new ProductVersionEntity(
                affectedProductId: $this->data[FieldInterface::FIELD_AFFECTED_PRODUCT_ID],
                version: $this->data[FieldInterface::FIELD_VERSION] ?? FieldInterface::FIELD_NULL,
                lessThan: $this->data[FieldInterface::FIELD_LESS_THAN] ?? FieldInterface::FIELD_NULL,
                status: $this->data[FieldInterface::FIELD_STATUS] ?? FieldInterface::FIELD_NULL,
                versionType: $this->data[FieldInterface::FIELD_VERSION_TYPE] ?? FieldInterface::FIELD_NULL
            )
        );
    }
}
