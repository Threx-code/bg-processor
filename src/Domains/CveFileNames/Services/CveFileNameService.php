<?php declare(strict_types=1);

namespace Domains\CveFileNames\Services;

use Domains\CveFileNames\Entities\CveFileNameEntity;
use Domains\CveFileNames\Models\CveFileNames;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;


final  class CveFileNameService extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate($model, CveFileNameEntity::class);

        /** @var CveFileNames $model */
        return CveFileNameEntity::fromEloquent($model);
    }
}
