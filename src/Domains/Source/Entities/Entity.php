<?php

declare(strict_types=1);

namespace Domains\Source\Entities;

use Domains\Source\Models\Source;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public ?string $fileName,
        public ?string $year,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    /**
     * @property int $id
     * @property string $key
     * @property string $fileName
     * @property string $year
     */

    public static function fromEloquent(Source $cveFileNames): Entity
    {
        return new self(
            fileName: $cveFileNames->fileName,
            year: $cveFileNames->year,
            key: $cveFileNames->key,
            id: $cveFileNames->id
        );
    }

    public function toArray(): array
    {
        return [
            'fileName' => $this->fileName,
            'year' => $this->year,
        ];
    }
}
