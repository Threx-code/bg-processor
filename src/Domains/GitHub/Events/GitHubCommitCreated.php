<?php declare(strict_types=1);

namespace Domains\GitHub\Events;

use Domains\GitHub\Entities\GitHubCommitEntity;
use Infrastructures\Events\DomainEvent;

final class GitHubCommitCreated extends DomainEvent
{
    public function __construct(
        public readonly GitHubCommitEntity $commit
    ){}
}
