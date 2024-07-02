<?php

namespace Domains\GitHub\ValueObjects;

use Carbon\Carbon;

class GithubCommitObject
{
    public function __construct(public \DateTimeImmutable $commitDate){}

    public function __toString(): string
    {
        return $this->commitDate->format('Y-m-d H:i:s');
    }
}
