<?php declare(strict_types=1);

namespace App\Console\Commands\Processor\Queries;

use Carbon\Carbon;
use Domains\GitHubCommit\Entities\Entity as GitHubCommitEntity;
use Domains\GitHubCommit\Repositories\Repository as GitHubCommitRepository;
use Domains\GitHubCommit\Services\Service as GitHubCommitService;
use Domains\GitHubCommit\Models\GithubCommit;
use Domains\Helpers\ValueObjects\DateObject;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use Throwable;

class GitHubCommitQuery
{
    public function service(): GitHubCommitService
    {
        return new GitHubCommitService(
            repository: new GitHubCommitRepository(
                query: GithubCommit::query(),
                database: resolve(
                    name: DatabaseManager::class
                )
            )
        );
    }

    /**
     * @throws Throwable
     */
    public function update(Collection $commits, $date): bool
    {
        $this->service()->update(
            key: $commits->first()->key,
            entity: new GitHubCommitEntity(
                commitDate: new DateObject(
                    date: Carbon::parse(
                        time: $date
                    )->toDateTimeImmutable()
                )
            )
        );

        return true;
    }

    /**
     * @throws Throwable
     */
    public function insert($date): bool
    {
        $this->service()->create(
            new GitHubCommitEntity(
                commitDate: new DateObject(
                    date: Carbon::parse(
                        time: $date
                    )->toDateTimeImmutable()

                )
            )
        );

        return true;
    }

}
