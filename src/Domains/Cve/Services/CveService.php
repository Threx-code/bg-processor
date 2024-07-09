<?php declare(strict_types=1);

namespace Domains\Cve\Services;

use Domains\Cve\Entities\CveEntity;
use Domains\Cve\Models\Cve;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Entities\DomainEntity;
use Infrastructures\Exceptions\ModelValidator;
use Infrastructures\Services\BaseService;


final  class CveService extends BaseService
{
    protected function mapToEntity(Model $model): DomainEntity
    {
        ModelValidator::validate($model, CveEntity::class);

        /** @var Cve $model */
        return CveEntity::fromEloquent($model);
    }
}
