<?php declare(strict_types=1);

namespace App\Console\Commands\Processor\Inserts;

use Domains\Helpers\Payloads\FieldInterface;
use Domains\Platform\Models\Platform;
use Illuminate\Database\Eloquent\Model;
use Domains\Platform\Services\Service as PlatformService;
use Domains\Platform\Repositories\Repository as PlatformRepository;
use Domains\Platform\Entities\Entity as PlatformEntity;

class PlatformStore extends BaseInsert
{

    public function process(): Model
    {
        return (new PlatformService(
            repository: new PlatformRepository(
                query: Platform::query(),
                database: self::dbResolver()
            )
        ))->create(
            entity: new PlatformEntity(
                affectedProductId: $this->data[FieldInterface::FIELD_AFFECTED_PRODUCT_ID],
                platform: $this->data[FieldInterface::FIELD_PLATFORM] ?? FieldInterface::FIELD_NULL
            )
        );
    }
}


