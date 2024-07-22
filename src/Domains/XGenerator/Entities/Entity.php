<?php

declare(strict_types=1);

namespace Domains\XGenerator\Entities;

use Domains\Cve\Models\Cve;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\XGenerator\Models\XGenerator;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public int $cveId,
        public ?string $engine,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(XGenerator $generator): Entity
    {
        return new self(
            cveId: $generator->cveId,
            engine: $generator->engine,
            key: $generator->key,
            id: $generator->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_CVE_ID => $this->cveId,
            FieldInterface::FIELD_ENGINE => $this->engine,
        ];
    }
}
