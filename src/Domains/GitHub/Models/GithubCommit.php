<?php declare(strict_types=1);

namespace Domains\GitHub\Models;

use Domains\GitHub\Casts\Date;
use Domains\GitHub\Observers\GithubCommitObserver;
use Domains\GitHub\ValueObjects\GithubCommitObject;
use Domains\Models\concerns\HasKey;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $key
 * @property int $id
 * @property GithubCommitObject $commitDate
 */

#[ObservedBy(GithubCommitObserver::class)]
class GithubCommit extends Model
{
    use HasFactory, HasKey;
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'commitDate' => Date::class
        ];
    }
}
