<?php

namespace App\Console\Commands\Processor\Inserts;

use App\Helpers\Dates\DateImmutable;
use App\Helpers\Jsons\ProcessJson;
use Domains\Helpers\Payloads\DefaultFieldInterface;
use Domains\Helpers\ValueObjects\DateObject;
use Domains\Helpers\ValueObjects\JsonObject;
use Illuminate\Database\DatabaseManager;
use Illuminate\Database\Eloquent\Model;

abstract class BaseInsert
{
    public function __construct(
        public readonly array $data
    ) {}

    protected static function dbResolver()
    {
        return resolve(name: DatabaseManager::class);
    }

    abstract public function process(): Model;

    public static function defaultDate(): string
    {
        return DefaultFieldInterface::FIELD_DEFAULT_DATE;
    }

    public static function emptyArray(): array
    {
        return DefaultFieldInterface::FIELD_EMPTY_ARRAY;
    }

    public static function emptyString(): string
    {
        return DefaultFieldInterface::FIELD_EMPTY_STRING;
    }

    public static function defaultNull(): null
    {
        return DefaultFieldInterface::FIELD_NULL;
    }

    public static function jsonFormat($data, $key): JsonObject
    {
        return new JsonObject(
            data: ProcessJson::format(
                data: $data[$key] ?? self::emptyArray()
            )
        );
    }

    public static function dateFormat($date, $key): DateObject
    {
        return new DateObject(
            date: DateImmutable::format(
                date: $date[$key] ?? self::defaultDate()
            )
        );
    }
}
