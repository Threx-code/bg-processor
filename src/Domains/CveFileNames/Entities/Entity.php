<?php

declare(strict_types=1);

namespace Domains\CveFileNames\Entities;

use Domains\CveFileNames\Models\CveFileNames;
use Domains\Helpers\Payloads\FieldInterface;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public ?string $fileName,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    /**
     * @property int $id
     * @property string $key
     * @property string $fileName
     * @property string $year
     */

    public static function fromEloquent(CveFileNames $cveFileNames): Entity
    {
        return new self(
            fileName: $cveFileNames->fileName,
            key: $cveFileNames->key,
            id: $cveFileNames->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_FILE_NAME => $this->fileName
        ];
    }
}
