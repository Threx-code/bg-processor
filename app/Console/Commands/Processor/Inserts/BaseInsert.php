<?php

namespace App\Console\Commands\Processor\Inserts;

use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;

abstract class BaseInsert
{
    public function __construct(
        public readonly array $data
    ){}
    protected static function dbResolver()
    {
        return resolve(name: DatabaseManager::class);
    }

    abstract public function process(): Model;
}
