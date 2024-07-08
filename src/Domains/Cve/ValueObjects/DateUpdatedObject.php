<?php

namespace Domains\Cve\ValueObjects;

class DateUpdatedObject
{
    public function __construct(public \DateTimeImmutable $dateUpdated){}

    public function __toString(): string
    {
        return $this->dateUpdated->format('Y-m-d H:i:s');
    }
}
