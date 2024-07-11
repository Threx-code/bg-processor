<?php

declare(strict_types=1);

namespace Domains\Credit\Entities;

use Domains\Adp\Models\Adp;
use Domains\Credit\Models\Credit;
use Domains\Cve\Models\Cve;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Helpers\ValueObjects\DateObject;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public Cve $cve,
        public ?string $lang,
        public ?string $type,
        public ?string $value,
        public ?string $key = null,
        public ?int $id = null
    ) {}


    public static function fromEloquent(Credit $credit): Entity
    {
        return new self(
            cve: $credit->cveId,
            lang: $credit->lang,
            type: $credit->type,
            value: $credit->value,
            key: $credit->key,
            id: $credit->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_CVE_ID => $this->cve->id,
            FieldInterface::FIELD_LANG => $this->lang,
            FieldInterface::FIELD_TYPE => $this->type,
            FieldInterface::FIELD_VALUE => $this->value
        ];
    }
}
