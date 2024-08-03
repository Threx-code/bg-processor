<?php

namespace App\Console\Commands\Processor\Queries;

use App\Helpers\Dates\DateImmutable;
use App\Helpers\Jsons\ProcessJson;
use Domains\Helpers\Payloads\DefaultFieldInterface;
use Domains\Helpers\ValueObjects\DateObject;
use Domains\Helpers\ValueObjects\JsonObject;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;
use Infrastructures\Services\BaseService;

abstract class BaseQuery
{
    public function __construct(
        public readonly array $data
    ) {}

    protected static function dbResolver()
    {
        return resolve(name: DatabaseManager::class);
    }

    abstract public function query();

}
