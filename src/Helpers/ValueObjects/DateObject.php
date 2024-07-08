<?php

namespace Domains\Helpers\ValueObjects;

use DateTimeImmutable;

class DateObject
{
    public function __construct(public DateTimeImmutable $date) {}

    public function __toString(): string
    {
        return $this->date->format('Y-m-d H:i:s');
    }
}
