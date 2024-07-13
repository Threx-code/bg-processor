<?php

declare(strict_types=1);

namespace Domains\GitHubCommit\Models;

use Domains\GitHubCommit\Observers\Observer as GitHubCommitObserver;
use Domains\Helpers\Casts\Date;
use Domains\Helpers\Payloads\FieldInterface;
use Domains\Helpers\ValueObjects\DateObject;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $key
 * @property int $id
 * @property DateObject $commitDate
 */
#[ObservedBy(GitHubCommitObserver::class)]
class GithubCommit extends Model
{
    use HasFactory, HasKey;

    protected $guarded = [];

    protected function casts(): array
    {
        return [
            FieldInterface::FIELD_COMMIT_DATE => Date::class,
        ];
    }
}
