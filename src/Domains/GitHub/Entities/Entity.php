<?php

declare(strict_types=1);

namespace Domains\GitHub\Entities;

use Domains\GitHub\Models\GithubCommit;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Helpers\ValueObjects\DateObject;
use Infrastructures\Entities\DomainEntity;

final class Entity extends DomainEntity
{
    public function __construct(
        public DateObject $commitDate,
        public ?string $key = null,
        public ?int $id = null
    ) {}

    public static function fromEloquent(GithubCommit $commit): Entity
    {
        return new self(
            commitDate: $commit->commitDate,
            key: $commit->key,
            id: $commit->id
        );
    }

    public function toArray(): array
    {
        return [
            FieldInterface::FIELD_COMMIT_DATE => $this->commitDate,
        ];
    }
}
