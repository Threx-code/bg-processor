<?php declare(strict_types=1);

namespace Infrastructures\Entities;

abstract class DomainEntity
{
    abstract public function toArray(): array;
}
