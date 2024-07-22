<?php

declare(strict_types=1);

namespace App\Console\Commands\Processor;

use App\Console\Commands\CLIInterface;
use App\Console\Commands\Dates\DateString;
use App\Console\Commands\Files\Commit\LastCommit;
use Carbon\Carbon;
use Domains\GitHubCommit\Entities\Entity;
use Domains\GitHubCommit\Models\GithubCommit;
use Domains\GitHubCommit\Repositories\Repository;
use Domains\GitHubCommit\Services\Service;
use Domains\Helpers\ValueObjects\DateObject;
use Illuminate\Console\Command;
use Illuminate\Database\DatabaseManager;
use Illuminate\Support\Collection;
use JsonException;
use Throwable;

class CveFile extends Command
{
    const DATE_FORMAT = 'Y-m-d H:i:s';

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'process:cve';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command to process cve files and save them to the database.';

    /**
     * Execute the console command.
     *
     * @throws JsonException
     * @throws Throwable
     */
    public function handle()
    {
        $commitDate = DateString::format(
            date: LastCommit::getDate()[CLIInterface::LAST_COMMIT_DATE]
        );

        $commits = $this->service()->all();
        $commitData = $commits->first();

        $dateFromDb = ! empty($commitData) ?
            $commitData->commitDate->date->format(self::DATE_FORMAT) : null;

        if ($commitDate !== $dateFromDb) {
            $directory = dirname(__FILE__, 5).CLIInterface::CVE_REPOSITORY_PATH;
            (new FileProcessor())->directory($directory);

            //$commitInserted = (! empty($checkCommitData->key)) ? $this->update($commits, $commitDate) : $this->insert($commitDate);
        }

        $this->info(CLIInterface::COMMAND_COMPLETED_MESSAGE);
    }

    private function service(): Service
    {
        return new Service(
            repository: new Repository(
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
    private function update(Collection $commits, $date): bool
    {
        $this->service()->update(
            key: $commits->first()->key,
            entity: new Entity(
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
    private function insert($date): bool
    {
        $this->service()->create(
            new Entity(
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
