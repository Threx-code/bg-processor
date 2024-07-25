<?php declare(strict_types=1);

namespace App\Console\Commands\Processor\Inserts;

use Domains\CveFileNames\Entities\Entity as CveFileNameEntity;
use Domains\CveFileNames\Models\CveFileNames;
use Domains\CveFileNames\Repositories\Repository as CveFileNameRepository;
use Domains\CveFileNames\Services\Service as CveFileNameService;
use Domains\Helpers\Payloads\FieldInterface;
use Illuminate\Database\Eloquent\Model;

class FileNameStore extends BaseInsert
{
    public function process(): Model
    {
        $service = new CveFileNameService(
            repository: new CveFileNameRepository(
                query: CveFileNames::query(),
                database: self::dbResolver()
            )
        );

        return $service->create(
            entity: new CveFileNameEntity(
                fileName: $this->data[FieldInterface::FIELD_FILE_NAME]
            )
        );
    }
}
