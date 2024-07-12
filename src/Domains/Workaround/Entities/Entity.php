<?php

declare(strict_types=1);

namespace Domains\Workaround\Entities;

use Domains\Cve\Models\Cve;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Workaround\Models\Workaround;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public Cve $cve,
        public ?string $lang,
        public ?string $value,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(Workaround $workaround): Entity
    {
        return new self(
            cve: $workaround->cveId,
            lang: $workaround->lang,
            value: $workaround->value,
            key: $workaround->key,
            id: $workaround->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_CVE_ID => $this->cve->id,
            FieldInterface::FIELD_LANG => $this->lang,
            FieldInterface::FIELD_VALUE => $this->value,
        ];
    }
}
