<?php declare(strict_types=1);

namespace App\Models\Github;

use App\Casts\Date;
use App\Models\concerns\HasKey;
use App\Observers\Github\GithubCommitObserver;
use Domains\GitHub\ValueObjects\GithubCommitObject;
use Illuminate\Database\Eloquent\Attributes\ObservedBy;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property string $key
 * @property int $id
 * @property GithubCommitObject $commit_date
 */

#[ObservedBy(GithubCommitObserver::class)]
class GithubCommit extends Model
{
    use HasFactory, HasKey;
    protected $guarded = [];

    protected function casts(): array
    {
        return [
            'commit_date' => Date::class
        ];
    }
}
