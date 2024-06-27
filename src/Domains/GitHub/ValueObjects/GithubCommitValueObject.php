<?php

namespace Domains\GitHub\ValueObjects;

class GithubCommitValueObject
{
    public function __construct(public string $commitDate){}

    public function toArray(): array
    {
        return [
            'commit_date' => $this->commitDate,
        ];
    }
}
