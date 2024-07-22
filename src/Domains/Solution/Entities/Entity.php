<?php

declare(strict_types=1);

namespace Domains\Solution\Entities;

use Domains\Cve\Models\Cve;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Solution\Models\Solution;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public int $cveId,
        public ?string $lang,
        public ?string $value,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    /**
     * @property int $id
     * @property string $key
     * @property Cve $cveId
     * @property string $lang
     * @property string $value
     */
    public static function fromEloquent(Solution $solution): Entity
    {
        return new self(
            cveId: $solution->cveId,
            lang: $solution->lang,
            value: $solution->value,
            key: $solution->key,
            id: $solution->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_CVE_ID => $this->cveId,
            FieldInterface::FIELD_LANG => $this->lang,
            FieldInterface::FIELD_VALUE => $this->value,
        ];
    }
}
